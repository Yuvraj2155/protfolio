<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Setting;

Route::get('/', function () {
    return Inertia::render('Portfolio/Home', [
        'skills'   => Skill::orderBy('sort_order')->get(),
        'projects' => Project::where('visible', true)->orderBy('sort_order')->get(),
        'settings' => Setting::pluck('value', 'key'),
    ]);
});

Route::get('/projects', function () {
    return Inertia::render('Portfolio/Projects', [
        'projects' => Project::where('visible', true)->orderBy('sort_order')->get(),
    ]);
});

Route::get('/contact', function () {
    return Inertia::render('Portfolio/Contact', [
        'settings' => Setting::pluck('value', 'key'),
    ]);
});

Route::post('/contact', [ContactController::class, 'store']);

// Admin routes
Route::get('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/login', [AdminController::class, 'doLogin']);
Route::get('/admin/logout', [AdminController::class, 'logout']);
Route::get('/admin', [AdminController::class, 'dashboard']);
Route::get('/admin/projects', [AdminController::class, 'projects']);
Route::post('/admin/projects', [AdminController::class, 'storeProject']);
Route::put('/admin/projects/{project}', [AdminController::class, 'updateProject']);
Route::delete('/admin/projects/{project}', [AdminController::class, 'deleteProject']);
Route::get('/admin/skills', [AdminController::class, 'skills']);
Route::post('/admin/skills', [AdminController::class, 'storeSkill']);
Route::delete('/admin/skills/{skill}', [AdminController::class, 'deleteSkill']);
Route::get('/admin/profile', [AdminController::class, 'profile']);
Route::post('/admin/profile', [AdminController::class, 'updateProfile']);
Route::post('/admin/sync-github', [AdminController::class, 'syncGithub']);