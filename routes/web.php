<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('posts')->name('blog.')->controller(PostController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/show/{post}-{slug}', 'show')->where([
        'id' => '[0-9]+',
        'slug' => '[a-z0-9\-]+'
    ])->name('show');
    Route::get('/enregistrer', 'create')->name('create');
    Route::post('/enregistrer', 'store')->name('store');
    Route::get('/{post}/edit', 'edit')->name('edit');
    Route::post('/{post}/edit', 'update')->name('update');
});

Route::prefix('categories')->name('category.')->controller(CategoryController::class)->group(function() {
    Route::get('/enregistrer', 'create')->name('create');
    Route::post('/enregistrer', 'store')->name('store');
});

Route::prefix('tags')->name('tags.')->controller(TagController::class)->group(function() {
    Route::get('/enregistrer', 'index')->name('index');
    Route::post('/enregistrer', 'store')->name('store');
});