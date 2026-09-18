<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // The up method describes the table Laravel creates when the migration runs.
        Schema::create('articles', function (Blueprint $table) {
            // id is the unique, automatically increasing number for each article.
            $table->id();
            // A title is required and stored as short text; content stores longer text.
            $table->string('title');
            $table->text('content');
            // author_id must match an existing id in the users table.
            // The same user ID may appear on many articles, giving one user many articles.
            $table->foreignId('author_id')->constrained('users');
            // New articles are private unless code explicitly makes them public.
            $table->boolean('is_public')->default(false);
            // Laravel manages the created_at and updated_at date columns automatically.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // The down method reverses this migration by removing the articles table.
        Schema::dropIfExists('articles');
    }
};
