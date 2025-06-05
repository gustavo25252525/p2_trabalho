<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\Bookcontroller;
use App\Http\Controllers\Genrecontroller;
use App\Http\Controllers\Reviewcontroller;
use App\Http\Controllers\Wearercontroller;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthorController::class)->group(function () {
    Route::get('/authors', 'get');
    Route::get('/authors/books', 'getWithBooks');
    Route::get('/authors/{id}', 'details');
    Route::post('/authors', 'store');
    Route::patch('/authors/{id}', 'update'); //patch alterar
    Route::delete('/authors/{id}', 'delete');
    Route::get('/authors/books/{id}', 'findBooks');
});


Route::controller(BookController::class)->group(function () {
    Route::get('/books', 'get');
    Route::get('/books/all', 'getWithReviewsAuthorAndGenres');
    Route::get('/books/{id}', 'details');
    Route::post('/books', 'store');
    Route::patch('/books/{id}', 'update');
    Route::delete('/books/{id}', 'delete');
    Route::get('/books/reviews/{id}', 'findReviews');
});



Route::controller(GenreController::class)->group(function () {
    Route::get('/genres', 'get');
    Route::get('/genres/books', 'getWithBooks');
    Route::get('/genres/{id}', 'details');
    Route::post('/genres', 'store');
    Route::patch('/genres/{id}', 'update');
    Route::delete('/genres/{id}', 'delete');
    Route::get('/genres/books/{id}', 'findBooks');
});


Route::controller(ReviewController::class)->group(function () {
    Route::get('/reviews', 'get');
    Route::get('/reviews/{id}', 'details');
    Route::post('/reviews', 'store');
    Route::patch('/reviews/{id}', 'update');
    Route::delete('/reviews/{id}', 'delete');
    Route::get('/reviews/books/{id}', 'findBooks');
    Route::get('/reviews/wearers/{id}', 'findWearers');

});


Route::controller(WearerController::class)->group(function () {
    Route::get('/wearers', 'get');
    Route::get('/wearers/{id}', 'details');
    Route::post('/wearers', 'store');
    Route::patch('/wearers/{id}', 'update');
    Route::delete('/wearers/{id}', 'delete');
    Route::get('/wearers/reviews/{id}', 'findReviews');
});
