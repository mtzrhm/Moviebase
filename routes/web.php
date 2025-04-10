<?php

use App\Http\Controllers\UserRatingController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::group(['middleware' => ['web']], function () {
    Route::get('/', \App\Livewire\MovieSearch::class)->name('home');
    Route::get('movie/{imdbId}', \App\Livewire\MovieShow::class)->name('movie.show');
});

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('ratings', \App\Livewire\UserRating::class)->name('ratings.index');
});


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';


