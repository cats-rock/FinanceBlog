<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    // Allow the factory and future Article forms to assign Tag attributes.
    protected $guarded = [];

    // Configure the other side of the many-to-many relationship: one Tag can be attached to many Articles.
    // Eloquent uses the same article_tag pivot table defined by Article::tags().
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
