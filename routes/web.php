<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () { return redirect()->route('posts.index'); });
Route::resource('posts', PostController::class);
Route::resource('genres', GenreController::class);
Route::resource('categories', CategoryController::class);