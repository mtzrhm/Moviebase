<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRatingRequest;
use App\Http\Requests\UpdateUserRatingRequest;
use App\Models\UserRating;
use Illuminate\Http\Request;

class UserRatingController extends Controller
{
    // theoretisch auch im konstruktor mittels $this->authorizeResource(UserRating::class');

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRatingRequest $request)
    {
        $this->authorize('create', UserRating::class);
    }

    /**
     * Display the specified resource.
     */
    public function show(UserRating $userRating)
    {
        $this->authorize('view', [UserRating::class, $userRating]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserRating $userRating)
    {
        $this->authorize('update', [UserRating::class, $userRating]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRatingRequest $request, UserRating $userRating)
    {
        $this->authorize('update', [UserRating::class, $userRating]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserRating $userRating)
    {
        $this->authorize('delete', UserRating::class);
    }
}
