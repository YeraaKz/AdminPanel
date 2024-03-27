<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\Admin\AdminAuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->name('admin.')->group(function (){

    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::prefix('dashboard')->name('dashboard.')->group(function (){

        Route::get('', [AdminController::class, 'dashboard'])->middleware('admin.auth');

        Route::prefix('posts')->name('posts.')->middleware('admin.auth')->group(function (){

            Route::get('export', [PostController::class, 'export'])->name('export');
            Route::get('search', [PostController::class, 'search'])->name('search');

            Route::get('filter', [PostController::class, 'filter'])->name('filter');
            Route::get('{post}', [PostController::class, 'show'])->name('show');
            Route::get('{post}/edit', [PostController::class, 'edit'])->name('edit');
            Route::put('{post}', [PostController::class, 'update'])->name('update');
            Route::post('process', [PostController::class, 'process'])->name('process');
            Route::post('close', [PostController::class, 'close'])->name('close');

        });
    });

});


