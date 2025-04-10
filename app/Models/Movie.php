<?php

namespace App\Models;

use App\Casts\MoviePosterCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    /** @use HasFactory<\Database\Factories\MovieFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'year',
        'released_at',
        'runtime',
        'genre',
        'plot',
        'languages',
        'poster',
        'imdb_rating',
        'imdb_id',
    ];

    protected $casts = [
        'languages' => 'json',
        'released_at' => 'datetime',
        'poster' => MoviePosterCast::class,
    ];



    public function ratings(): HasMany
    {
        return $this->hasMany(UserRating::class, 'movie_id', 'id');
    }
}
