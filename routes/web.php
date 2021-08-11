<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('article.')->group(function(){
    Route::get('/', [ App\Http\Controllers\ArticleController::class, 'index' ])->name('index');
    Route::post('/', [ App\Http\Controllers\ArticleController::class, 'store' ])->name('store');
    Route::get('/create', [ App\Http\Controllers\ArticleController::class, 'create' ])->name('create');
    Route::get('/import', [ App\Http\Controllers\ArticleController::class, 'import' ])->name('import');
    Route::post('/import', [ App\Http\Controllers\ArticleController::class, 'importUpload' ]);
    Route::get('/{article}', [ App\Http\Controllers\ArticleController::class, 'edit' ])->name('edit');
    Route::post('/{article}', [ App\Http\Controllers\ArticleController::class, 'update' ])->name('update');
});