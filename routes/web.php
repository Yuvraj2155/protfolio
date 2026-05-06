<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Portfolio/Home');
});

Route::get('/projects', function () {
    return Inertia::render('Portfolio/Projects');
});

Route::get('/contact', function () {
    return Inertia::render('Portfolio/Contact');
});
Route::post('/contact', [ContactController::class, 'store']);