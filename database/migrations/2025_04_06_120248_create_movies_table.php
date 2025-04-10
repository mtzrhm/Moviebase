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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->integer('year')->default(1970);
            $table->date('released_at')->nullable();
            $table->integer('runtime')->default(0);
            $table->string('genre')->default('Unknown');
            $table->string('plot')->default('Unknown');
            $table->json('languages')->nullable();
            $table->string('poster')->nullable();
            $table->decimal('imdb_rating')->default(0.0);
            $table->string('imdb_id')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
