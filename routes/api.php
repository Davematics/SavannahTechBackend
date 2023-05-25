<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Auth route
Route::prefix('/v1')->group(function () {
Route::post('/register', [App\Http\Controllers\Api\Auth\AuthController::class, 'UserRegistration']);
Route::post('/login', [App\Http\Controllers\Api\Auth\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Api\Auth\AuthController::class, 'logout'])->middleware(['auth:sanctum']);
});

//books route
Route::prefix('/v1/books')->middleware(['auth:sanctum'])->group(function () {

Route::post('/', [App\Http\Controllers\Api\Book\BookController::class, 'store']);
Route::get('/', [App\Http\Controllers\Api\Book\BookController::class, 'index']);
Route::get('/{id}', [App\Http\Controllers\Api\Book\BookController::class, 'show']);
Route::put('/{id}', [App\Http\Controllers\Api\Book\BookController::class, 'update']);
Route::delete('/{id}', [App\Http\Controllers\Api\Book\BookController::class, 'destory']);

});


//author route
Route::prefix('/v1/authors')->middleware(['auth:sanctum'])->group(function () {

Route::get('/', [App\Http\Controllers\Api\Author\AuthorController::class, 'index']);
});