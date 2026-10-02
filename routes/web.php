<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'pages.home')->name('home');

Route::get('/', [HomeController::class, 'index'])->name('home');
