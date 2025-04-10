<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'imdb_id' => $this->imdb_id,
            'slug' => $this->slug,
            'title' => $this->title,
            'year' => $this->year,
            'poster' => $this->poster,
            'plot' => $this->plot,
            'runtime' => $this->runtime,
            'genre' => $this->genre,
            'released_at' => $this->released_at,
            'imdb_rating' => $this->imdb_rating,
            'ratings_avg_rating' => !empty($this->ratings_avg_rating) ? number_format($this->ratings_avg_rating, 2, '.', '') : 0,
            'ratings_count' => !empty($this->ratings_count) ? $this->ratings_count : 0,
        ];
    }
}
