<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProfileController;

Route::get('dashboard',[AdminController::class, 'dashboard'])->name('dashboard');

// profile routes
Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile/update/password', [ProfileController::class, 'updateProfilePassword'])->name('profile.update.password');


// routes category
Route::resource('category', CategoryController::class);