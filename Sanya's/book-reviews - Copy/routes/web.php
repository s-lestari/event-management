<?php

use App\Models\Book;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookController;
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
    return redirect()->route('books.index');
});


Route::resource('books', BookController::class);

Route::resource('books.reviews', ReviewController::class)
    ->scoped(['reviews' => 'books'])
    ->only(['create', 'store']);

Route::get('reviews/{review}', [ReviewController::class, 'show'])
    ->name('reviews.show')
    ->middleware('auth');
