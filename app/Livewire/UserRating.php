<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserRating extends Component
{
    protected int $userId;
    public Collection $ratings;

    public function boot(): void
    {
        $this->userId = Auth::id();
    }

    public function mount(): void
    {
        $this->authorize('viewAny', \App\Models\UserRating::class);

        $this->loadRatings();
    }

    private function loadRatings(): void
    {
        $this->ratings = \App\Models\UserRating::where('user_id', $this->userId)
            ->with('movie')
            ->get()
            ->groupBy('movie_id')
            ->map(function ($ratings) {
                $movie = $ratings->first()->movie;
                $userRating = $ratings->first();
                $allRatings = $movie->ratings;

                return [
                    'movie' => $movie,
                    'user_rating' => $userRating->rating,
                    'user_rating_id' => $userRating->id,
                    'average_rating' => round($allRatings->avg('rating'), 1),
                    'total_votes' => $allRatings->count(),
                ];
            });
    }

    public function deleteRating(\App\Models\UserRating $userRating): void
    {
        $this->authorize('delete', [\App\Models\UserRating::class, $userRating]);

        $rating = \App\Models\UserRating::where('id', $userRating->id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $rating->delete();

        $this->loadRatings();
    }

    public function render()
    {
        return view('livewire.user-rating')
            ->layout('components.layouts.app');
    }
}
