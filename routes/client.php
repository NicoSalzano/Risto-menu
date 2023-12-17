<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ClientController;

Route::get('dashboard',[ClientController::class, 'dashboard'])->name('dashboard');
