<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function show($id)
    {
        $article = \Illuminate\Support\Facades\Cache::get('article_' . $id);
        
        if (!$article) {
            abort(404, 'Artikel tidak ditemukan atau sesi pencarian telah kadaluarsa. Silakan lakukan pencarian ulang.');
        }
        
        return view('detail', compact('article'));
    }
}
