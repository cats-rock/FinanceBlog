<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create the pivot table that stores the many-to-many connections between Articles and Tags.
     */
    public function up(): void
    {
        Schema::create('article_tag', function (Blueprint $table) {
            // Each row connects one Article ID with one Tag ID; no timestamps are needed for this relationship.
            $table->foreignId('article_id');
            $table->foreignId('tag_id');
        });
    }

    /**
     * Remove the pivot table when this migration is rolled back.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_tag');
    }
};
