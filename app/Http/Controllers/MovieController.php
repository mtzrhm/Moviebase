<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function show(string $imdbId)
    {
        $dbMovie = Movie::where('imdb_id', $imdbId)
            ->withAvg('ratings', 'rating')
            ->withCount('ratings')
            ->firstOrFail();
        $movie = (new MovieResource($dbMovie))->resolve();

        return view('movies.show', compact('movie'));
    }
}
