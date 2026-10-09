<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    /** @use HasFactory<\Database\Factories\ToolFactory> */
    use HasFactory;

   // Allow the factory and future Tool forms to mass assign Tool attributes.
    protected $guarded = [];

    // Each Tool belongs to one User through user_id.
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
