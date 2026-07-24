<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Repository;

class JournalController extends Controller
{
    public function search(Request $request)
    {
        $query = Article::with(['authors', 'repository']);

        // Wajib q
        if ($request->filled('q')) {
            $searchTerm = $request->input('q');
            $query->whereRaw("MATCH(title, abstract) AGAINST(? IN BOOLEAN MODE)", [$searchTerm]);
        }

        // Filter Source
        if ($request->filled('source') && $request->input('source') !== 'all') {
            $sourceNames = explode(',', $request->input('source'));
            $query->whereHas('repository', function ($q) use ($sourceNames) {
                // Handle lowercase and space variations
                $q->whereIn('name', array_map('ucfirst', $sourceNames))
                  ->orWhereIn(\DB::raw('LOWER(name)'), array_map('strtolower', $sourceNames));
            });
        }

        if ($request->filled('year_from')) {
            $query->where('publication_year', '>=', $request->input('year_from'));
        }

        if ($request->filled('year_to')) {
            $query->where('publication_year', '<=', $request->input('year_to'));
        }

        if ($request->filled('language') && $request->input('language') !== 'all') {
            $lang = $request->input('language');
            if ($lang === 'id') {
                $query->whereIn('language', ['id', 'ind', 'indonesian', 'indonesia']);
            } elseif ($lang === 'en') {
                $query->whereIn('language', ['en', 'eng', 'english']);
            } else {
                $query->where('language', $lang);
            }
        }

        // Sorting
        $sort = $request->input('sort', 'relevance');
        if ($sort === 'year_desc') {
            $query->orderBy('publication_year', 'desc')->orderBy('id', 'desc');
        } elseif ($sort === 'year_asc') {
            $query->orderBy('publication_year', 'asc')->orderBy('id', 'asc');
        } elseif ($sort === 'citations') {
            $query->orderBy('id', 'asc'); 
        } else {
            // relevance
            if (!$request->filled('q')) {
                $query->orderBy('publication_year', 'desc')->orderBy('id', 'desc');
            }
        }

        $page = $request->input('page', 1);
        $articles = $query->paginate(20, ['*'], 'page', $page);

        // Format to match Jurnalin API response structure
        $results = $articles->map(function ($article) {
            return [
                'id' => strtolower($article->repository->name ?? 'internal') . '_' . $article->id,
                'title' => $article->title,
                'authors' => $article->authors->map(function ($author) {
                    return ['name' => $author->name];
                })->toArray(),
                'source' => $article->repository->name ?? 'Internal',
                'year' => (int) $article->publication_year,
                'doi' => $article->doi,
                'is_open_access' => true,
                'link' => url('/article/' . $article->id),
            ];
        });

        // Get unique active sources dynamically
        $sources = Repository::whereHas('articles')->pluck('name')->toArray();

        return response()->json([
            'results' => $results,
            'total' => $articles->total(),
            'page' => $articles->currentPage(),
            'sources' => $sources,
        ]);
    }

    public function show($id)
    {
        // Extract internal ID if it's in format "source_ID"
        $internalId = $id;
        if (strpos($id, '_') !== false) {
            $parts = explode('_', $id);
            $internalId = end($parts);
        }

        $article = Article::with(['authors', 'repository'])->find($internalId);

        if (!$article) {
            return response()->json(['error' => 'Not Found'], 404);
        }

        return response()->json([
            'id' => strtolower($article->repository->name ?? 'internal') . '_' . $article->id,
            'title' => $article->title,
            'abstract' => $article->abstract,
            'authors' => $article->authors->map(function ($author) {
                return ['name' => $author->name];
            })->toArray(),
            'source' => $article->repository->name ?? 'Internal',
            'year' => (int) $article->publication_year,
            'doi' => $article->doi,
            'language' => $article->language,
            'urls' => [
                'pdf' => $article->pdf_url,
                'source' => $article->source_url,
                'app_link' => url('/article/' . $article->id)
            ],
            'is_open_access' => true,
        ]);
    }

    public function sources()
    {
        $sources = Repository::withCount('articles')->get()->map(function ($repo) {
            return [
                'id' => strtolower($repo->name),
                'name' => $repo->name,
                'total_documents' => $repo->articles_count,
            ];
        });

        return response()->json([
            'sources' => $sources
        ]);
    }
}
