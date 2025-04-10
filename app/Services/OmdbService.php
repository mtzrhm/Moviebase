<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class OmdbService
{
    protected ?string $baseUri;
    protected ?string $apiKey;

    public function __construct()
    {
        $this->baseUri = config('services.omdb.api_uri');
        $this->apiKey = config('services.omdb.api_key');
    }

    public function search(string $query, string $type = 'movie'): Collection
    {
        if (is_null($this->baseUri) || is_null($this->apiKey)) {
            return collect();
        }

        $response = Http::get($this->baseUri, [
            'apikey' => $this->apiKey,
            's' => $query,
            'type' => $type,
        ]);

        if (!$response->successful() || $response['Response'] === 'False') {
            return collect();
        }

        return collect($response['Search']);
    }

    public function fetchByImdbId(string $imdbId, string $type = 'movie'): ?array
    {
        if (is_null($this->baseUri) || is_null($this->apiKey)) {
            return [];
        }

        $response = Http::get($this->baseUri, [
            'apikey' => $this->apiKey,
            'i' => $imdbId,
            'type' => $type,
        ]);

        $data = $response->json();

        if (!$response->successful() || $data['Response'] === 'False') {
            return null;
        }

        return $data;
    }
}
