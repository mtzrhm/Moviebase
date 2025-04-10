<?php
use App\Livewire\MovieShow;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('renders movie details', function () {
    $movie = Movie::factory()->create();

    Livewire::test(MovieShow::class, ['imdbId' => $movie->imdb_id])
        ->assertStatus(200)
        ->assertSee($movie->title);
});

test('shows "Jetzt bewerten"-Button if user is logged in', function () {
    $user = User::factory()->create();
    $movie = Movie::factory()->create();

    Livewire::actingAs($user)
        ->test(MovieShow::class, ['imdbId' => $movie->imdb_id])
        ->assertSee('Jetzt bewerten');
});

test('saves a user rating and updates average', function () {
    $user = User::factory()->create();
    $movie = Movie::factory()->create();

    expect($movie->ratings()->count())->toBe(0);

    Livewire::actingAs($user)
        ->test(MovieShow::class, ['imdbId' => $movie->imdb_id])
        ->set('rating', 4)
        ->call('submitRating');

    expect($movie->ratings()->count())->toBe(1);
    expect($movie->ratings()->first()->rating)->toBe(4.0);
});
