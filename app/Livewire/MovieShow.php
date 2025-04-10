<?php

namespace App\Livewire;

use App\Http\Resources\MovieResource;
use App\Models\Movie;
use App\Models\UserRating;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MovieShow extends Component
{
    public Movie $movie;
    public ?UserRating $userRating = null;
    public bool $showModal = false;
    public int $rating = 0;

    public function mount(string $imdbId): void
    {
        $this->loadMovie($imdbId);

        $this->userRating = UserRating::where([
            ['user_id', Auth::id()],
            ['movie_id', $this->movie->id],
        ])->first();

        if (!is_null($this->userRating)) {
            $this->rating = $this->userRating->rating;
        }
    }

    public function openModal(): void
    {
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;

        $this->rating = $this->userRating?->rating ?? 0;
    }

    public function submitRating(): void
    {
        $this->authorize('create', UserRating::class);

        UserRating::updateOrCreate(
            [
                'movie_id' => $this->movie->id,
                'user_id' => auth()->id(),
            ],
            [
                'rating' => $this->rating,
            ]
        );

        $this->movie->refresh();
        $this->userRating?->refresh();

        $this->closeModal();
    }

    public function getAverageRatingProperty()
    {
        return $this->movie->ratings()->avg('rating') ?? 0;
    }

    public function getRatingCounterProperty(): int
    {
        return $this->movie->ratings()->count() ?? 0;
    }

    public function loadMovie(string $imdbId): void
    {
        $this->movie = Movie::where('imdb_id', $imdbId)
            ->withAvg('ratings', 'rating')
            ->withCount('ratings')
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.movie-show')
            ->layout('components.layouts.base');
    }
}
