<?php

use App\Services\OmdbService;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $this->service = new OmdbService();
});

test('search returns movie results from OMDB API', function () {
    Http::fake([
        '*' => Http::response([
            'Response' => 'True',
            'Search' => [
                ['Title' => 'Final Destination', 'imdbID' => 'tt123'],
                ['Title' => 'Final Destination 2', 'imdbID' => 'tt456'],
            ],
        ]),
    ]);

    $results = $this->service->search('Final Destination');

    expect($results)->toHaveCount(2);
    expect($results[0]['imdbID'])->toBe('tt123');
});

test('search returns empty array when API response is False', function () {
    Http::fake([
        '*' => Http::response(['Response' => 'False']),
    ]);

    $results = $this->service->search('NothingHere');

    expect($results)->toBeCollection()->toBeEmpty();
});

test('fetchByImdbId returns movie details', function () {
    Http::fake([
        '*' => Http::response([
            'Response' => 'True',
            'Title' => 'Final Destination',
            'imdbID' => 'tt123',
        ]),
    ]);

    $movie = $this->service->fetchByImdbId('tt123');

    expect($movie)->not()->toBeNull();
    expect($movie['imdbID'])->toBe('tt123');
});

test('fetchByImdbId returns null when movie not found', function () {
    Http::fake([
        '*' => Http::response(['Response' => 'False']),
    ]);

    $movie = $this->service->fetchByImdbId('ttInvalid');

    expect($movie)->toBeNull();
});
