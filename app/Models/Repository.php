<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    protected $fillable = ['name', 'base_url', 'last_harvested_at', 'status'];

    protected $casts = [
        'last_harvested_at' => 'datetime',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
