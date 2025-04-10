<?php

namespace App\Livewire;

use App\Http\Resources\MovieCollection;
use App\Services\MovieSearchService;
use Illuminate\Support\Collection;
use Livewire\Component;

class MovieSearch extends Component
{
    protected MovieSearchService $movieSearchService;
    public bool $isSearching = false;
    public bool $hasSearched = false;
    public string $search = '';
    public string $type = 'movie';
    public array $movies = [];

    public function boot(MovieSearchService $movieSearchService): void
    {
        $this->movieSearchService = $movieSearchService;
        $this->movies = [];
    }

    public function updatedSearch(): void
    {
        $this->isSearching = true;

        $this->movies = $this->movieSearchService->search($this->search, $this->type);

        $this->isSearching = false;
        $this->hasSearched = true;
    }

    public function clearMovieSearch(): void
    {
        $this->search = '';
        $this->movies = [];
        $this->hasSearched = false;
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.movie-search')
            ->layout('components.layouts.base');
    }
}
