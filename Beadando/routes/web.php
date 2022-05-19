<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers;
use App\Http\Controllers\Controller;
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
Route::get('/', [Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/add', [Controllers\ProductController::class, 'create'])->name('product.create');
    Route::post('/add', [Controllers\ProductController::class, 'store']);

    Route::get('/product/{product}/edit',[Controllers\ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/{product}/edit',[Controllers\ProductController::class, 'update']);
    Route::get('/product/{product}/delete',[Controllers\ProductController::class, 'destroy'])->name('product.delete');

    Route::post('/product/{product}/comment',[Controllers\ProductController::class, 'comment'])->name('product.comment');

    Route::get('/profile/{user}/edit',[Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/{user}/edit',[Controllers\ProfileController::class, 'update']);
    Route::get('/product/{product}/buy',[Controllers\ProductController::class, 'buy'])->name('product.buy');
});

Route::get('/product/{product}', [Controllers\ProductController::class, 'show'])->name('product.details');
Route::get('/type/{type}',[Controllers\TypeController::class,'show'])->name('type.show');
Route::get('/publisher/{publisher}',[Controllers\PublisherController::class,'show'])->name('publisher.show');


Route::get('/profile/{user}', [Controllers\ProfileController::class, 'show'])->name('profile.show');

require __DIR__.'/auth.php';
