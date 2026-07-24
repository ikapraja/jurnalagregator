<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Repository;
use App\Models\Article;
use App\Models\Author;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HarvestOaiPmh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oai:harvest {--repository_id= : The ID of a specific repository to harvest}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Harvest metadata from OAI-PMH endpoints';

    /**
     * Kata Kunci untuk Kluster
     */
    protected $clusters = [
        'Transportasi & Multimoda' => ['transportasi', 'multimoda', 'logistik', 'jalan raya', 'jembatan', 'perkerasan', 'lalu lintas', 'transportation', 'freight', 'transit'],
        'Otomotif & Energi Terbarukan' => ['otomotif', 'mesin', 'engine', 'kendaraan listrik', 'ev', 'baterai', 'biodiesel', 'solar', 'renewable energy', 'emisi', 'mekanik'],
        'Sistem Cerdas & Big Data' => ['big data', 'machine learning', 'artificial intelligence', 'ai', 'its', 'intelligent transport', 'data spasial', 'iot', 'sensor']
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $repoId = $this->option('repository_id');
        
        if ($repoId) {
            $repositories = Repository::where('id', $repoId)->where('status', 'active')->get();
        } else {
            $repositories = Repository::where('status', 'active')->get();
        }

        if ($repositories->isEmpty()) {
            $this->info("No active repositories found to harvest.");
            return;
        }

        foreach ($repositories as $repo) {
            $this->info("Starting harvest for: {$repo->name} ({$repo->base_url})");
            $this->harvestRepository($repo);
            $repo->update(['last_harvested_at' => now()]);
            $this->info("Completed harvest for: {$repo->name}");
        }
    }

    protected function harvestRepository(Repository $repo)
    {
        $resumptionToken = null;
        $url = $repo->base_url;
        $params = [
            'verb' => 'ListRecords',
            'metadataPrefix' => 'oai_dc'
        ];

        do {
            if ($resumptionToken) {
                $params = [
                    'verb' => 'ListRecords',
                    'resumptionToken' => $resumptionToken
                ];
            }

            try {
                $response = Http::timeout(60)->get($url, $params);
                
                if (!$response->successful()) {
                    $this->error("Failed to connect to {$url}. Status: " . $response->status());
                    break;
                }

                $xml = simplexml_load_string($response->body());
                if ($xml === false) {
                    $this->error("Failed to parse XML from {$url}");
                    break;
                }

                // Register namespaces
                $xml->registerXPathNamespace('oai', 'http://www.openarchives.org/OAI/2.0/');
                $xml->registerXPathNamespace('oai_dc', 'http://www.openarchives.org/OAI/2.0/oai_dc/');
                $xml->registerXPathNamespace('dc', 'http://purl.org/dc/elements/1.1/');

                // Process records
                $records = $xml->xpath('//oai:record');
                if (!$records) {
                    $this->info("No more records found.");
                    break;
                }

                foreach ($records as $record) {
                    $this->processRecord($repo, $record);
                }

                // Check for resumption token
                $tokenElement = $xml->xpath('//oai:resumptionToken');
                $resumptionToken = (isset($tokenElement[0]) && (string)$tokenElement[0] !== '') ? (string)$tokenElement[0] : null;

                if ($resumptionToken) {
                    $this->info("Resumption token found, fetching next batch...");
                    // Optional delay to respect server rates
                    sleep(1);
                }

            } catch (\Exception $e) {
                $this->error("Error harvesting {$repo->name}: " . $e->getMessage());
                Log::error("OAI-PMH Harvest Error: " . $e->getMessage());
                break;
            }

        } while ($resumptionToken);
    }

    protected function processRecord(Repository $repo, \SimpleXMLElement $record)
    {
        $header = $record->children('http://www.openarchives.org/OAI/2.0/')->header;
        $status = (string)$header['status'];
        $identifier = (string)$header->identifier;

        // Skip deleted records
        if ($status === 'deleted') {
            return;
        }

        $metadata = $record->children('http://www.openarchives.org/OAI/2.0/')->metadata;
        if (!$metadata) return;

        $oai_dc = $metadata->children('http://www.openarchives.org/OAI/2.0/oai_dc/')->dc;
        if (!$oai_dc) return;

        $dc = $oai_dc->children('http://purl.org/dc/elements/1.1/');

        $title = isset($dc->title[0]) ? (string)$dc->title[0] : null;
        $abstract = isset($dc->description[0]) ? (string)$dc->description[0] : null;
        $date = isset($dc->date[0]) ? (string)$dc->date[0] : null;
        
        if (!$title) return; // Title is mandatory for us

        // Extract Language
        $language = null;
        if (isset($dc->language)) {
            $langStr = (string)$dc->language[0];
            $language = strtolower(substr($langStr, 0, 50));
        }

        // Extract URL and DOI
        $sourceUrl = $identifier; // Fallback
        $pdfUrl = null;
        $doi = null;

        $allIds = [];
        if (isset($dc->identifier)) {
            foreach ($dc->identifier as $id) {
                $allIds[] = (string)$id;
            }
        }
        if (isset($dc->relation)) {
            foreach ($dc->relation as $rel) {
                $allIds[] = (string)$rel;
            }
        }

        foreach ($allIds as $idStr) {
            if (filter_var($idStr, FILTER_VALIDATE_URL)) {
                // Tautan PDF Galley di OJS biasanya memiliki 2 ID: /article/view/123/456
                if (preg_match('/\/article\/view\/\d+\/\d+/', $idStr)) {
                    $pdfUrl = $idStr;
                }
                // Tautan Artikel (Source) di OJS biasanya memiliki 1 ID: /article/view/123
                elseif (preg_match('/\/article\/view\/\d+$/', $idStr) || preg_match('/\/article\/view\/\d+\/?$/', $idStr)) {
                    $sourceUrl = $idStr;
                }
                // Tautan PDF lain (fallback)
                elseif (strpos(strtolower($idStr), '.pdf') !== false || strpos(strtolower($idStr), '/download/') !== false) {
                    if (!$pdfUrl) $pdfUrl = $idStr;
                }
                
                // Ekstrak DOI jika URL berupa org/10...
                if (strpos($idStr, 'doi.org/') !== false) {
                    $doi = $idStr;
                }
            } else if (strpos(strtolower($idStr), 'doi:') !== false || strpos($idStr, '10.') === 0) {
                $doi = strpos(strtolower($idStr), 'http') === false ? 'https://doi.org/' . str_replace('doi:', '', strtolower($idStr)) : $idStr;
            }
        }

        // Parse Date
        $pubYear = null;
        $pubDate = null;
        if ($date) {
            if (preg_match('/^\d{4}$/', $date)) {
                $pubYear = $date;
            } elseif (strtotime($date)) {
                $pubDate = date('Y-m-d', strtotime($date));
                $pubYear = date('Y', strtotime($date));
            }
        }

        // Determine Cluster
        $cluster = $this->determineCluster($title, $abstract, $dc->subject ?? []);

        // Create or Update Article
        $article = Article::updateOrCreate(
            ['oai_identifier' => $identifier],
            [
                'repository_id' => $repo->id,
                'title' => $title,
                'abstract' => $abstract,
                'publication_year' => $pubYear,
                'publication_date' => $pubDate,
                'source_url' => $sourceUrl,
                'pdf_url' => $pdfUrl,
                'doi' => $doi,
                'language' => $language,
                'cluster' => $cluster
            ]
        );

        // Process Authors
        if (isset($dc->creator)) {
            $authorIds = [];
            foreach ($dc->creator as $creator) {
                $authorName = trim((string)$creator);
                if (!empty($authorName)) {
                    $author = Author::firstOrCreate(['name' => $authorName]);
                    $authorIds[] = $author->id;
                }
            }
            if (!empty($authorIds)) {
                $article->authors()->sync($authorIds);
            }
        }
    }

    protected function determineCluster($title, $abstract, $subjects)
    {
        $textToSearch = strtolower($title . ' ' . $abstract);
        foreach ($subjects as $subject) {
            $textToSearch .= ' ' . strtolower((string)$subject);
        }

        foreach ($this->clusters as $clusterName => $keywords) {
            foreach ($keywords as $keyword) {
                // Gunakan word boundary (\b) agar pencocokan tepat, misalnya 'ai' tidak cocok dengan 'air'
                if (preg_match('/\b' . preg_quote($keyword, '/') . '\b/i', $textToSearch)) {
                    return $clusterName;
                }
            }
        }

        return 'Belum Terklasifikasi';
    }
}
