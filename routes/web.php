<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login.index');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('/series', SeriesController::class)->except('show');
    Route::get('/series/home', [SeriesController::class, 'home'])->name('series.home');
    Route::get('/series/show/{series}', [SeriesController::class, 'show'])->name('series.show');
    Route::post('/series/{id}/seasonsWatched', [SeriesController::class, 'seasonsWatched'])->name('seasonsWatched');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('signin');
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/register', [UsersController::class, 'create'])->name('users.create');
Route::post('/register', [UsersController::class, 'store'])->name('users.store');
