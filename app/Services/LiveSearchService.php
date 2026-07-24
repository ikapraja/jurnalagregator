<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Http\Client\Pool;

class LiveSearchService
{
    public function search($keyword, $page = 1, $perPage = 10, $sort = 'relevansi', $yearFrom = null, $yearTo = null, $language = 'all', $source = 'all')
    {
        $cacheKey = "search_" . md5($keyword . $page . $perPage . $sort . $yearFrom . $yearTo . $language . $source);
        
        return Cache::remember($cacheKey, 3600, function () use ($keyword, $page, $perPage, $sort, $yearFrom, $yearTo, $language, $source) {
            $limitPerSource = $perPage > 20 ? 40 : 15; 
            $offset = ($page - 1) * $perPage;

            $responses = Http::pool(function (Pool $pool) use ($keyword, $limitPerSource, $offset, $page, $source) {
                $requests = [];
                if ($source === 'all' || $source === 'crossref') {
                    $requests[] = $pool->as('crossref')->timeout(15)->get("https://api.crossref.org/works", [
                        'query' => $keyword,
                        'rows' => $limitPerSource,
                        'offset' => $offset,
                        'select' => 'DOI,title,abstract,author,URL,language,published-print,published-online,is-referenced-by-count',
                        'mailto' => env('CROSSREF_MAILTO', 'admin@jurnalagregator.local')
                    ]);
                }
                if ($source === 'all' || $source === 'arxiv') {
                    $requests[] = $pool->as('arxiv')->timeout(15)->get("http://export.arxiv.org/api/query?search_query=all:" . urlencode($keyword) . "&start={$offset}&max_results={$limitPerSource}");
                }
                if ($source === 'all' || $source === 'doaj') {
                    $requests[] = $pool->as('doaj')->timeout(15)->get("https://doaj.org/api/search/articles/" . urlencode($keyword), [
                        'page' => $page,
                        'pageSize' => $limitPerSource
                    ]);
                }
                if ($source === 'all' || $source === 'semantic_scholar') {
                    $requests[] = $pool->as('semantic_scholar')->timeout(15)
                        ->withHeaders(env('SEMANTIC_SCHOLAR_API_KEY') ? ['x-api-key' => env('SEMANTIC_SCHOLAR_API_KEY')] : [])
                        ->get("https://api.semanticscholar.org/graph/v1/paper/search", [
                            'query' => $keyword,
                            'offset' => $offset,
                            'limit' => $limitPerSource,
                            'fields' => 'title,abstract,authors,year,publicationDate,url,openAccessPdf,externalIds,citationCount'
                        ]);
                }
                if ($source === 'all' || $source === 'openalex') {
                    $requests[] = $pool->as('openalex')->timeout(15)->get("https://api.openalex.org/works", [
                        'search' => $keyword,
                        'page' => $page,
                        'per-page' => $limitPerSource,
                        'mailto' => env('CROSSREF_MAILTO', 'admin@jurnalagregator.local')
                    ]);
                }
                if ($source === 'all' || $source === 'europepmc') {
                    $requests[] = $pool->as('europepmc')->timeout(15)->get("https://www.ebi.ac.uk/europepmc/webservices/rest/search", [
                        'query' => $keyword,
                        'format' => 'json',
                        'resultType' => 'core',
                        'pageSize' => $limitPerSource
                    ]);
                }

                if (env('CORE_API_KEY') && ($source === 'all' || $source === 'core')) {
                    $requests[] = $pool->as('core')->timeout(15)
                        ->withToken(env('CORE_API_KEY'))
                        ->get("https://api.core.ac.uk/v3/search/works", [
                            'q' => $keyword,
                            'limit' => $limitPerSource,
                            'offset' => $offset
                        ]);
                }

                if (env('IEEE_API_KEY') && ($source === 'all' || $source === 'ieee')) {
                    $requests[] = $pool->as('ieee')->timeout(15)->get("https://ieeexploreapi.ieee.org/api/v1/search/articles", [
                        'querytext' => $keyword,
                        'max_records' => $limitPerSource,
                        'start_record' => $offset + 1,
                        'apikey' => env('IEEE_API_KEY')
                    ]);
                }

                return $requests;
            });

            $crossrefData = $this->processCrossref($responses['crossref'] ?? null);
            $arxivData = $this->processArxiv($responses['arxiv'] ?? null);
            $doajData = $this->processDoaj($responses['doaj'] ?? null);
            $semanticData = $this->processSemanticScholar($responses['semantic_scholar'] ?? null);
            $openalexData = $this->processOpenAlex($responses['openalex'] ?? null);
            $europeData = $this->processEuropePmc($responses['europepmc'] ?? null);
            
            $coreData = ['items' => [], 'total' => 0];
            $ieeeData = ['items' => [], 'total' => 0];
            
            if (isset($responses['core'])) {
                $coreData = $this->processCore($responses['core']);
            }
            if (isset($responses['ieee'])) {
                $ieeeData = $this->processIeee($responses['ieee']);
            }

            $totalResults = $crossrefData['total'] + $arxivData['total'] + $doajData['total'] + 
                            $semanticData['total'] + $openalexData['total'] + $europeData['total'] +
                            $coreData['total'] + $ieeeData['total'];

            $allItems = array_merge(
                $crossrefData['items'],
                $arxivData['items'],
                $doajData['items'],
                $semanticData['items'],
                $openalexData['items'],
                $europeData['items'],
                $coreData['items'],
                $ieeeData['items']
            );

            $allItems = array_filter($allItems, function($item) use ($yearFrom, $yearTo, $language) {
                if ($yearFrom && $item->publication_year < $yearFrom) return false;
                if ($yearTo && $item->publication_year > $yearTo) return false;
                
                if ($language && $language !== 'all') {
                    $lang = strtolower((string)$item->language);
                    if ($language === 'id') {
                        if (!in_array($lang, ['id', 'ind', 'indonesian', 'indonesia'])) return false;
                    } elseif ($language === 'en') {
                        if (!in_array($lang, ['en', 'eng', 'english'])) return false;
                    } else {
                        if ($lang !== $language) return false;
                    }
                }
                return true;
            });

            usort($allItems, function($a, $b) use ($sort) {
                if ($sort === 'terbaru') {
                    return $b->publication_year <=> $a->publication_year;
                } elseif ($sort === 'terlama') {
                    return $a->publication_year <=> $b->publication_year;
                } elseif ($sort === 'sitasi') {
                    return $b->citation_count <=> $a->citation_count;
                }
                return 0; 
            });

            $unique = [];
            $seenTitles = [];
            foreach ($allItems as $item) {
                $titleKey = strtolower(preg_replace('/[^a-z0-9]/i', '', $item->title));
                if (!isset($seenTitles[$titleKey])) {
                    $seenTitles[$titleKey] = true;
                    // Beri ID unik jika belum ada dan simpan ke Cache untuk halaman Detail
                    $item->id = $item->id ?? md5($item->title . ($item->doi ?? $item->source_url));
                    \Illuminate\Support\Facades\Cache::put('article_' . $item->id, $item, 86400); // 24 jam
                    $unique[] = $item;
                }
            }
            
            $finalItems = array_slice($unique, 0, $perPage);

            return [
                'total' => $totalResults,
                'items' => $finalItems
            ];
        });
    }

    private function processCrossref($response)
    {
        if (!$response instanceof \Illuminate\Http\Client\Response || !$response->successful()) return ['items'=>[], 'total'=>0];
        $items = $response->json('message.items') ?? [];
        $total = $response->json('message.total-results') ?? 0;
        
        $parsed = [];
        foreach ($items as $item) {
            $year = $item['published-print']['date-parts'][0][0] ?? $item['published-online']['date-parts'][0][0] ?? null;
            $authors = array_map(fn($a) => trim(($a['given'] ?? '') . ' ' . ($a['family'] ?? '')), $item['author'] ?? []);
            $abstract = isset($item['abstract']) ? preg_replace('/<[^>]*>/', '', strip_tags($item['abstract'])) : null;
            
            $obj = $this->createArticleObject('Crossref', [
                'title' => $item['title'][0] ?? '',
                'journal_name' => $item['container-title'][0] ?? null,
                'abstract' => $abstract,
                'year' => $year,
                'source_url' => $item['URL'] ?? null,
                'doi' => $item['DOI'] ?? null,
                'authors' => array_filter($authors),
                'language' => $item['language'] ?? null,
                'citation_count' => $item['is-referenced-by-count'] ?? 0,
            ]);
            if ($obj) $parsed[] = $obj;
        }
        return ['items' => $parsed, 'total' => $total];
    }

    private function processArxiv($response)
    {
        if (!$response instanceof \Illuminate\Http\Client\Response || !$response->successful()) return ['items'=>[], 'total'=>0];
        $xml = @simplexml_load_string($response->body());
        if (!$xml) return ['items'=>[], 'total'=>0];
        
        $total = (int)($xml->children('opensearch', true)->totalResults ?? 0);
        $parsed = [];
        if (isset($xml->entry)) {
            foreach ($xml->entry as $entry) {
                $authors = [];
                foreach ($entry->author as $author) $authors[] = (string)$author->name;
                $pdfUrl = null;
                foreach ($entry->link as $link) {
                    if ((string)$link['title'] === 'pdf') $pdfUrl = (string)$link['href'];
                }
                $year = isset($entry->published) ? substr((string)$entry->published, 0, 4) : null;
                $doi = (string)($entry->children('arxiv', true)->doi ?? '');

                $obj = $this->createArticleObject('arXiv', [
                    'title' => (string)$entry->title,
                    'journal_name' => 'arXiv preprint',
                    'abstract' => trim((string)$entry->summary),
                    'year' => $year,
                    'source_url' => (string)$entry->id,
                    'pdf_url' => $pdfUrl,
                    'doi' => $doi,
                    'authors' => $authors,
                    'language' => 'en',
                ]);
                if ($obj) $parsed[] = $obj;
            }
        }
        return ['items' => $parsed, 'total' => $total];
    }

    private function processDoaj($response)
    {
        if (!$response instanceof \Illuminate\Http\Client\Response || !$response->successful()) return ['items'=>[], 'total'=>0];
        $total = $response->json('total') ?? 0;
        $results = $response->json('results') ?? [];
        
        $parsed = [];
        foreach ($results as $item) {
            $bib = $item['bibjson'] ?? [];
            $authors = array_map(fn($a) => $a['name'] ?? '', $bib['author'] ?? []);
            
            $doi = null; $url = null;
            foreach ($bib['identifier'] ?? [] as $id) if ($id['type'] === 'doi') $doi = $id['id'];
            foreach ($bib['link'] ?? [] as $l) if ($l['type'] === 'fulltext') $url = $l['url'];

            $obj = $this->createArticleObject('DOAJ', [
                'title' => $bib['title'] ?? '',
                'journal_name' => $bib['journal']['title'] ?? null,
                'abstract' => $bib['abstract'] ?? null,
                'year' => $bib['year'] ?? null,
                'source_url' => $url,
                'doi' => $doi,
                'authors' => array_filter($authors),
                'language' => $bib['language'][0] ?? null,
            ]);
            if ($obj) $parsed[] = $obj;
        }
        return ['items' => $parsed, 'total' => $total];
    }

    private function processSemanticScholar($response)
    {
        if (!$response instanceof \Illuminate\Http\Client\Response || !$response->successful()) return ['items'=>[], 'total'=>0];
        $total = $response->json('total') ?? 0;
        $data = $response->json('data') ?? [];
        
        $parsed = [];
        foreach ($data as $item) {
            $authors = array_map(fn($a) => $a['name'] ?? '', $item['authors'] ?? []);
            $obj = $this->createArticleObject('Semantic Scholar', [
                'title' => $item['title'] ?? '',
                'journal_name' => $item['venue'] ?? null,
                'abstract' => $item['abstract'] ?? null,
                'year' => $item['year'] ?? null,
                'source_url' => $item['url'] ?? null,
                'pdf_url' => $item['openAccessPdf']['url'] ?? null,
                'doi' => $item['externalIds']['DOI'] ?? null,
                'authors' => array_filter($authors),
                'language' => 'en',
                'citation_count' => $item['citationCount'] ?? 0,
            ]);
            if ($obj) $parsed[] = $obj;
        }
        return ['items' => $parsed, 'total' => $total];
    }

    private function processOpenAlex($response)
    {
        if (!$response instanceof \Illuminate\Http\Client\Response || !$response->successful()) return ['items'=>[], 'total'=>0];
        $total = $response->json('meta.count') ?? 0;
        $results = $response->json('results') ?? [];
        
        $parsed = [];
        foreach ($results as $item) {
            $authors = array_map(fn($a) => $a['author']['display_name'] ?? '', $item['authorships'] ?? []);
            $doi = str_replace('https://doi.org/', '', $item['doi'] ?? '');
            
            $obj = $this->createArticleObject('OpenAlex', [
                'title' => $item['title'] ?? '',
                'journal_name' => $item['primary_location']['source']['display_name'] ?? null,
                'abstract' => null,
                'year' => $item['publication_year'] ?? null,
                'source_url' => $item['id'] ?? null,
                'pdf_url' => $item['open_access']['oa_url'] ?? null,
                'doi' => $doi,
                'authors' => array_filter($authors),
                'language' => $item['language'] ?? 'en',
                'citation_count' => $item['cited_by_count'] ?? 0,
            ]);
            if ($obj) $parsed[] = $obj;
        }
        return ['items' => $parsed, 'total' => $total];
    }

    private function processEuropePmc($response)
    {
        if (!$response instanceof \Illuminate\Http\Client\Response || !$response->successful()) return ['items'=>[], 'total'=>0];
        $total = $response->json('hitCount') ?? 0;
        $results = $response->json('resultList.result') ?? [];
        
        $parsed = [];
        foreach ($results as $item) {
            $authors = array_map(fn($a) => trim(($a['firstName'] ?? '') . ' ' . ($a['lastName'] ?? '')), $item['authorList']['author'] ?? []);
            
            $obj = $this->createArticleObject('Europe PMC', [
                'title' => $item['title'] ?? '',
                'journal_name' => $item['journalTitle'] ?? null,
                'abstract' => $item['abstractText'] ?? null,
                'year' => $item['pubYear'] ?? null,
                'source_url' => 'https://europepmc.org/article/' . ($item['source'] ?? 'MED') . '/' . ($item['pmid'] ?? ''),
                'doi' => $item['doi'] ?? null,
                'authors' => array_filter($authors),
                'language' => $item['language'] ?? 'en',
                'citation_count' => $item['citedByCount'] ?? 0,
            ]);
            if ($obj) $parsed[] = $obj;
        }
        return ['items' => $parsed, 'total' => $total];
    }

    private function processCore($response)
    {
        if (!$response instanceof \Illuminate\Http\Client\Response || !$response->successful()) return ['items'=>[], 'total'=>0];
        $total = $response->json('totalHits') ?? 0;
        $results = $response->json('results') ?? [];
        
        $parsed = [];
        foreach ($results as $item) {
            $authors = array_map(fn($a) => $a['name'] ?? '', $item['authors'] ?? []);
            $obj = $this->createArticleObject('CORE', [
                'title' => $item['title'] ?? '',
                'journal_name' => $item['journals'][0]['title'] ?? $item['publisher'] ?? null,
                'abstract' => $item['abstract'] ?? null,
                'year' => $item['yearPublished'] ?? null,
                'source_url' => $item['sourceFulltextUrls'][0] ?? ($item['downloadUrl'] ?? null),
                'pdf_url' => $item['downloadUrl'] ?? null,
                'doi' => $item['doi'] ?? null,
                'authors' => array_filter($authors),
                'language' => $item['language']['code'] ?? 'en',
            ]);
            if ($obj) $parsed[] = $obj;
        }
        return ['items' => $parsed, 'total' => $total];
    }

    private function processIeee($response)
    {
        if (!$response instanceof \Illuminate\Http\Client\Response || !$response->successful()) return ['items'=>[], 'total'=>0];
        $total = $response->json('total_records') ?? 0;
        $results = $response->json('articles') ?? [];
        
        $parsed = [];
        foreach ($results as $item) {
            $authors = array_map(fn($a) => $a['full_name'] ?? '', $item['authors']['authors'] ?? []);
            $obj = $this->createArticleObject('IEEE Xplore', [
                'title' => $item['title'] ?? '',
                'journal_name' => $item['publication_title'] ?? null,
                'abstract' => $item['abstract'] ?? null,
                'year' => $item['publication_year'] ?? null,
                'source_url' => $item['html_url'] ?? null,
                'pdf_url' => $item['pdf_url'] ?? null,
                'doi' => $item['doi'] ?? null,
                'authors' => array_filter($authors),
                'language' => 'en',
                'citation_count' => $item['citing_paper_count'] ?? 0,
            ]);
            if ($obj) $parsed[] = $obj;
        }
        return ['items' => $parsed, 'total' => $total];
    }

    private function createArticleObject($repoName, $data)
    {
        if (empty($data['title'])) return null;
        
        $obj = new \stdClass();
        $obj->id = Str::uuid()->toString();
        $obj->title = Str::limit($data['title'], 250);
        $obj->journal_name = $data['journal_name'] ?? null;
        $obj->abstract = $data['abstract'] ?? '';
        $obj->publication_year = $data['year'] ?? null;
        $obj->source_url = $data['source_url'] ?? '#';
        $obj->pdf_url = $data['pdf_url'] ?? null;
        $obj->doi = $data['doi'] ?? null;
        $obj->language = $data['language'] ?? 'en';
        $obj->citation_count = $data['citation_count'] ?? 0;
        
        $repo = new \stdClass();
        $repo->name = $repoName;
        $obj->repository = $repo;

        $authorsList = [];
        if (!empty($data['authors'])) {
            foreach ($data['authors'] as $name) {
                if (is_array($name)) $name = $name['name'] ?? ''; // fallback
                if (empty(trim($name))) continue;
                $a = new \stdClass();
                $a->name = trim($name);
                $authorsList[] = $a;
            }
        }
        $obj->authors = $authorsList;
        $obj->cluster = $this->determineCluster($obj->title, $obj->abstract);

        return $obj;
    }

    private function determineCluster($title, $abstract)
    {
        $text = strtolower($title . ' ' . $abstract);
        
        $clusters = [
            'Keselamatan Transportasi' => ['keselamatan transportasi', 'road safety', 'traffic safety', 'accident', 'kecelakaan', 'helm', 'seatbelt', 'crash', 'pedestrian'],
            'Otomotif & Energi Terbarukan' => ['kendaraan listrik', 'mobil listrik', 'electric vehicle', ' ev ', 'battery', 'baterai', 'lithium', 'otomotif', 'energi terbarukan'],
            'Sistem Cerdas & Big Data' => ['sistem cerdas', 'big data', 'machine learning', 'artificial intelligence', ' ai ', 'deep learning', 'neural network', 'iot', 'data mining'],
            'Transportasi & Multimoda' => ['transportasi', 'multimoda', 'rel', 'railway', 'kereta', 'bus', 'angkutan', 'public transport', 'transit', 'jalan tol', 'highway']
        ];

        foreach ($clusters as $clusterName => $keywords) {
            foreach ($keywords as $keyword) {
                if (strpos($text, $keyword) !== false) return $clusterName;
            }
        }
        return 'Belum Terklasifikasi';
    }
}
