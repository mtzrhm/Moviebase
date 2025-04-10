<?php

use App\Livewire\UserRating;
use App\Models\Movie;
use App\Models\UserRating as UserRatingModel;
use App\Models\User;
use Livewire\Livewire;

it('shows only movies rated by the logged-in user', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();
    $movie1 = Movie::factory()->create();
    $movie2 = Movie::factory()->create();

    UserRatingModel::create([
        'movie_id' => $movie1->id,
        'user_id' => $user->id,
        'rating' => 5,
    ]);

    UserRatingModel::create([
        'movie_id' => $movie2->id,
        'user_id' => $otherUser->id,
        'rating' => 3,
    ]);

    Livewire::actingAs($user)
        ->test(UserRating::class)
        ->assertSee($movie1->title)
        ->assertDontSee($movie2->title);
});

it('deletes user rating and updates the list', function () {
    $user = User::factory()->create();
    $movie = Movie::factory()->create();

    $rating = UserRatingModel::create([
        'movie_id' => $movie->id,
        'user_id' => $user->id,
        'rating' => 4,
    ]);

    Livewire::actingAs($user)
        ->test(UserRating::class)
        ->call('deleteRating', $rating->id)
        ->assertDontSee($movie->title);

    expect(UserRatingModel::where('id', $rating->id)->exists())->toBeFalse();
});
