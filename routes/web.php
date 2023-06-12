<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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