<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// An Article object represents one row in the "articles" database table.
// Laravel finds that table automatically by pluralizing the model name.
class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    // HasFactory allows us to call Article::factory() when creating test or sample data.
    use HasFactory;

    // Allow Article::create() to assign the submitted attributes; use $fillable for tighter control later.
    protected $guarded = [];

    // One article belongs to one User; author_id is matched with that user's id.
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
