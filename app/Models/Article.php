<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'repository_id',
        'oai_identifier',
        'title',
        'abstract',
        'publication_year',
        'publication_date',
        'source_url',
        'pdf_url',
        'doi',
        'language',
        'citation_count',
        'cluster'
    ];

    public function repository()
    {
        return $this->belongsTo(Repository::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'article_authors', 'article_id', 'author_id');
    }
}
