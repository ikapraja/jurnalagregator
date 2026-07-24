<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\Author;
use App\Models\Repository;
use Carbon\Carbon;

class HarvestExternalApi extends Command
{
    protected $signature = 'harvest:external {keyword} {--limit=20} {--cluster=Belum Terklasifikasi}';
    protected $description = 'Harvest articles from Crossref, arXiv, DOAJ, and Semantic Scholar based on keyword';

    public function handle()
    {
        $keyword = $this->argument('keyword');
        $limit = $this->option('limit');
        $cluster = $this->option('cluster');

        $this->info("Memulai pencarian untuk kata kunci: '{$keyword}' (Batas per sumber: {$limit})");

        $this->harvestCrossref($keyword, $limit, $cluster);
        $this->harvestArxiv($keyword, $limit, $cluster);
        $this->harvestDoaj($keyword, $limit, $cluster);
        $this->harvestSemanticScholar($keyword, $limit, $cluster);

        $this->info("Proses Harvest Eksternal Selesai!");
    }

    private function saveArticle($repoName, $data)
    {
        if (empty($data['title'])) return;
        
        $repository = Repository::where('name', $repoName)->first();
        if (!$repository) return;

        // Cegah duplikasi berdasarkan DOI atau URL
        $query = Article::where('repository_id', $repository->id);
        if (!empty($data['doi'])) {
            $query->where('doi', $data['doi']);
        } elseif (!empty($data['source_url'])) {
            $query->where('source_url', $data['source_url']);
        } else {
            $query->where('title', $data['title']); // Fallback
        }

        $article = $query->first();

        if (!$article) {
            $article = Article::create([
                'repository_id' => $repository->id,
                'oai_identifier' => $data['identifier'] ?? Str::uuid()->toString(),
                'title' => Str::limit($data['title'], 250),
                'abstract' => $data['abstract'],
                'publication_year' => $data['year'],
                'publication_date' => $data['date'] ?? null,
                'source_url' => $data['source_url'],
                'pdf_url' => $data['pdf_url'] ?? null,
                'doi' => $data['doi'] ?? null,
                'language' => $data['language'] ?? null,
                'citation_count' => $data['citation_count'] ?? 0,
                'cluster' => $data['cluster'] ?? 'Belum Terklasifikasi',
            ]);

            // Save authors
            if (!empty($data['authors'])) {
                foreach ($data['authors'] as $authorName) {
                    $authorName = trim($authorName);
                    if (empty($authorName)) continue;
                    
                    $author = Author::firstOrCreate(['name' => Str::limit($authorName, 250)]);
                    $article->authors()->attach($author->id);
                }
            }
            $this->line(" Disimpan: " . Str::limit($data['title'], 50));
        } else {
            // Update optional
        }
    }

    private function harvestCrossref($keyword, $limit, $cluster)
    {
        $this->info("Mengambil dari Crossref...");
        try {
            $response = Http::timeout(60)->get("https://api.crossref.org/works", [
                'query' => $keyword,
                'rows' => $limit,
                'select' => 'DOI,title,abstract,author,URL,language,published-print,published-online,is-referenced-by-count',
            ]);

            if ($response->successful()) {
                $items = $response->json('message.items');
                foreach ($items as $item) {
                    $year = null;
                    if (isset($item['published-print']['date-parts'][0][0])) {
                        $year = $item['published-print']['date-parts'][0][0];
                    } elseif (isset($item['published-online']['date-parts'][0][0])) {
                        $year = $item['published-online']['date-parts'][0][0];
                    }

                    $authors = [];
                    if (isset($item['author'])) {
                        foreach ($item['author'] as $a) {
                            $name = trim(($a['given'] ?? '') . ' ' . ($a['family'] ?? ''));
                            if ($name) $authors[] = $name;
                        }
                    }

                    $abstract = null;
                    if (isset($item['abstract'])) {
                        $abstract = strip_tags($item['abstract']);
                        $abstract = preg_replace('/<[^>]*>/', '', $abstract); 
                    }

                    $this->saveArticle('Crossref', [
                        'title' => $item['title'][0] ?? null,
                        'abstract' => $abstract,
                        'year' => $year,
                        'source_url' => $item['URL'] ?? null,
                        'doi' => $item['DOI'] ?? null,
                        'authors' => $authors,
                        'language' => $item['language'] ?? null,
                        'citation_count' => $item['is-referenced-by-count'] ?? 0,
                        'cluster' => $cluster
                    ]);
                }
            }
        } catch (\Exception $e) {
            $this->error("Gagal Crossref: " . $e->getMessage());
        }
    }

    private function harvestArxiv($keyword, $limit, $cluster)
    {
        $this->info("Mengambil dari arXiv...");
        try {
            $url = "http://export.arxiv.org/api/query?search_query=all:" . urlencode($keyword) . "&max_results={$limit}";
            $response = Http::timeout(60)->get($url);
            
            if ($response->successful()) {
                $xml = simplexml_load_string($response->body());
                if ($xml && isset($xml->entry)) {
                    foreach ($xml->entry as $entry) {
                        $authors = [];
                        foreach ($entry->author as $author) {
                            $authors[] = (string)$author->name;
                        }

                        $pdfUrl = null;
                        foreach ($entry->link as $link) {
                            if ((string)$link['title'] === 'pdf') {
                                $pdfUrl = (string)$link['href'];
                            }
                        }
                        
                        $year = null;
                        if (isset($entry->published)) {
                            $year = substr((string)$entry->published, 0, 4);
                        }
                        
                        $doi = null;
                        $arxiv = $entry->children('arxiv', true);
                        if (isset($arxiv->doi)) {
                            $doi = (string)$arxiv->doi;
                        }

                        $this->saveArticle('arXiv', [
                            'title' => (string)$entry->title,
                            'abstract' => trim((string)$entry->summary),
                            'year' => $year,
                            'source_url' => (string)$entry->id,
                            'pdf_url' => $pdfUrl,
                            'doi' => $doi,
                            'authors' => $authors,
                            'language' => 'en', // arxiv mostly en
                            'cluster' => $cluster
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            $this->error("Gagal arXiv: " . $e->getMessage());
        }
    }

    private function harvestDoaj($keyword, $limit, $cluster)
    {
        $this->info("Mengambil dari DOAJ...");
        try {
            $response = Http::timeout(60)->get("https://doaj.org/api/search/articles/" . urlencode($keyword), [
                'pageSize' => $limit
            ]);

            if ($response->successful()) {
                $results = $response->json('results');
                if ($results) {
                    foreach ($results as $item) {
                        $bib = $item['bibjson'] ?? [];
                        
                        $authors = [];
                        if (isset($bib['author'])) {
                            foreach ($bib['author'] as $a) {
                                if (isset($a['name'])) $authors[] = $a['name'];
                            }
                        }

                        $doi = null;
                        $url = null;
                        if (isset($bib['identifier'])) {
                            foreach ($bib['identifier'] as $id) {
                                if ($id['type'] === 'doi') $doi = $id['id'];
                            }
                        }
                        if (isset($bib['link'])) {
                            foreach ($bib['link'] as $l) {
                                if ($l['type'] === 'fulltext') $url = $l['url'];
                            }
                        }

                        $this->saveArticle('DOAJ', [
                            'title' => $bib['title'] ?? null,
                            'abstract' => $bib['abstract'] ?? null,
                            'year' => $bib['year'] ?? null,
                            'source_url' => $url,
                            'doi' => $doi,
                            'authors' => $authors,
                            'language' => $bib['language'][0] ?? null,
                            'cluster' => $cluster
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            $this->error("Gagal DOAJ: " . $e->getMessage());
        }
    }

    private function harvestSemanticScholar($keyword, $limit, $cluster)
    {
        $this->info("Mengambil dari Semantic Scholar...");
        try {
            $response = Http::timeout(60)->get("https://api.semanticscholar.org/graph/v1/paper/search", [
                'query' => $keyword,
                'limit' => $limit,
                'fields' => 'title,abstract,authors,year,publicationDate,url,openAccessPdf,externalIds,citationCount'
            ]);

            if ($response->successful()) {
                $data = $response->json('data');
                if ($data) {
                    foreach ($data as $item) {
                        $authors = [];
                        if (isset($item['authors'])) {
                            foreach ($item['authors'] as $a) {
                                if (isset($a['name'])) $authors[] = $a['name'];
                            }
                        }

                        $this->saveArticle('Semantic Scholar', [
                            'title' => $item['title'] ?? null,
                            'abstract' => $item['abstract'] ?? null,
                            'year' => $item['year'] ?? null,
                            'source_url' => $item['url'] ?? null,
                            'pdf_url' => $item['openAccessPdf']['url'] ?? null,
                            'doi' => $item['externalIds']['DOI'] ?? null,
                            'authors' => $authors,
                            'language' => 'en', 
                            'citation_count' => $item['citationCount'] ?? 0,
                            'cluster' => $cluster
                        ]);
                    }
                }
            } else {
                 $this->error("Gagal Semantic Scholar: " . $response->body());
            }
        } catch (\Exception $e) {
            $this->error("Gagal Semantic Scholar: " . $e->getMessage());
        }
    }
}
