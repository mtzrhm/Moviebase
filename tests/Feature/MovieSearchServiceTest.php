<?php

use App\Models\Movie;
use App\Services\MovieSearchService;
use App\Services\OmdbService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('returns movies from cache if available', function () {
    $cachedIds = collect(['tt123']);

    Cache::shouldReceive('get')
        ->once()
        ->with('search:final-destination')
        ->andReturn($cachedIds);

    Movie::factory()->create(['imdb_id' => 'tt123']);

    $omdb = Mockery::mock(OmdbService::class);
    $service = new MovieSearchService($omdb);

    $movies = $service->search('Final Destination');

    expect($movies)->toHaveCount(1);
    expect($movies[0]['imdb_id'])->toBe('tt123');
});

test('calls OMDB and stores movie if not in cache', function () {
    Cache::shouldReceive('get')->once()->andReturn(null);
    Cache::shouldReceive('put')->once();

    $omdb = Mockery::mock(OmdbService::class);

    $omdb->shouldReceive('search')->once()->andReturn(collect([
        ['Title' => 'Final Destination', 'imdbID' => 'tt123']
    ]));

    $omdb->shouldReceive('fetchByImdbId')->once()->andReturn([
        'Title' => 'Final Destination',
        'Year' => '2000',
        'Released' => '2000-03-17',
        'Runtime' => '98 min',
        'Genre' => 'Horror',
        'Plot' => 'Some plot',
        'Language' => 'English',
        'Poster' => 'http://example.com/poster.jpg',
        'imdbRating' => '6.7',
        'Response' => 'True',
        'imdbID' => 'tt123',
    ]);

    $service = new MovieSearchService($omdb);

    $results = $service->search('Final Destination');

    expect($results)->toHaveCount(1);
    expect($results[0]['title'])->toBe('Final Destination');
});
