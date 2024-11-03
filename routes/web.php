<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/about', function () {
    return "About Us";
});

Route::prefix('posts')->controller(PostController::class)->group(function () {
    Route::get('/', 'index')->name('posts.index');
    Route::post('/', 'store')->name('posts.store');
    Route::get('/create', 'create')->name('posts.create');
    Route::get('/{id}', 'show')->name('posts.show');
    Route::get('/{post}/edit', 'edit')->name('posts.edit');
    Route::delete('/{post}', 'destroy')->name('posts.destroy');
    Route::put('/{post}', 'update')->name('posts.update');
});




