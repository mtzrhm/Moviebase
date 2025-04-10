<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MovieCollection extends ResourceCollection
{
    public $collects = MovieResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function toArray(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return MovieResource::collection($this->collection);
    }
}
