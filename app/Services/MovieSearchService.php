<?php

namespace App\Services;

use App\Http\Resources\MovieCollection;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class MovieSearchService
{
    public function __construct(protected OmdbService $omdbService)
    {

    }

    public function search(string $query, string $type = 'movie'): array
    {
        if (mb_strlen($query) < 3) {
            return [];
        }

        $cacheKey = 'search:' . str($query)->slug();

        $imdbIds = Cache::get($cacheKey);

        if (!$imdbIds) {
            $searchResults = $this->omdbService->search($query, $type);
            $imdbIds = collect($searchResults)->pluck('imdbID');
            Cache::put($cacheKey, $imdbIds, now()->addHours(24));
        }

        $this->syncMissingMovies($imdbIds, $type);
        return $this->loadMovies($imdbIds);
    }

    protected function syncMissingMovies(Collection $imdbIds, string $type): void
    {
        $imdbIds->each(function ($imdbId) use ($type) {
            if (Movie::where('imdb_id', $imdbId)->exists()) {
                return;
            }

            $apiData = $this->omdbService->fetchByImdbId($imdbId, $type);
            if (!$apiData) return;

            Movie::create([
                'title' => $apiData['Title'],
                'slug' => str($apiData['Title'])->slug(),
                'year' => $apiData['Year'],
                'released_at' => $apiData['Released'] === 'N/A' ? null : Carbon::parse($apiData['Released']),
                'runtime' => str_contains($apiData['Runtime'], 'min')
                    ? (int) str_replace('min', '', $apiData['Runtime'])
                    : 0,
                'genre' => $apiData['Genre'],
                'plot' => $apiData['Plot'],
                'languages' => explode(',', $apiData['Language']),
                'poster' => $apiData['Poster'],
                'imdb_rating' => $apiData['imdbRating'] === 'N/A' ? 0 : (float) $apiData['imdbRating'],
                'imdb_id' => $imdbId,
            ]);
        });
    }

    protected function loadMovies(Collection $imdbIds): array
    {
        return Movie::whereIn('imdb_id', $imdbIds)
            ->withAvg('ratings', 'rating')
            ->get()
            ->map(function (Movie $movie) {
                return (new MovieResource($movie))->resolve();
            })->toArray();
    }
}

