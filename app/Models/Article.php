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

    // Configure the many-to-many relationship: an Article can have many Tags through the article_tag pivot table.
    // This method teaches Eloquent how to find the related Tags; the migration creates the actual pivot table.
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // Decide whether a specific User may edit, update, or delete this Article.
    public function canChange(User $user): bool
    {
        // The User who wrote the Article may manage their own work.
        if ($user->id === $this->author_id) {
            return true;
        }

        // An administrator may manage any Article, including one written by another User.
        if ($user->is_admin) {
            return true;
        }

        // Every other authenticated User is denied.
        return false;
    }
}
