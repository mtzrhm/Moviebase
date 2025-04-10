<?php

namespace App\Http\Controllers;

use App\Services\OmdbService;
use Illuminate\Http\Request;

class DebugController extends Controller
{
    public function __invoke()
    {
        $omdbService = new OmdbService();
        $collection = $omdbService->search('Final Destination');
        dd($collection);
    }
}
