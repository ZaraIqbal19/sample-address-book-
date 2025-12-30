<?php

use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('user.index');
});

// Dashboard route (named)
Route::get('/geniedashboard', function () {
    return view('Genie.dashboard'); // Make sure this Blade exists
})->name('geniedashboard');

// Authenticated routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
