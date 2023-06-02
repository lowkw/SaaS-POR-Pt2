<?php

use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\AuthorAPIController;
use App\Http\Controllers\API\BookAPIController;
use App\Http\Controllers\API\GenreAPIController;
use App\Http\Controllers\API\PublisherAPIController;
use App\Http\Controllers\API\UserAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('register',[AuthAPIController::class,'register']);
Route::post('login', [AuthAPIController::class, 'login']);

/*
Route::apiResource('/authors', AuthorAPIController::class);
Route::apiResource('/books', BookAPIController::class);
Route::apiResource('/users', UserAPIController::class);
Route::apiResource('/publishers', PublisherAPIController::class);
Route::apiResource('/genres', GenreAPIController::class);
*/

// Authentication required API Routes (Auth-Sanctum Middleware)
Route::group(['middleware' => ['auth:sanctum']], function () {

    /* Prefix the given routes with /authors
     * Based on http://laravel-school.com/posts/building-a-delighted-restful-api-with-laravel-16
     */
    Route::prefix('authors')->group(function () {
        Route::get('/', [AuthorAPIController::class, 'index']);
     //   Route::get("{id}", [AuthorAPIController::class, 'show']);
     //   Route::post('/', [AuthorAPIController::class, 'store']);
     //   Route::put('/{id}', [AuthorAPIController::class, 'update']);
     //   Route::delete('/{id}', [AuthorAPIController::class, 'destroy']);
    });

    /* Prefix the given routes with /genres
     * Based on http://laravel-school.com/posts/building-a-delighted-restful-api-with-laravel-16
    */
    Route::prefix('genres')->group(function () {
        Route::get('/', [GenreAPIController::class, 'index']);
        Route::get("{id}", [GenreAPIController::class, 'show']);
        Route::post('/', [GenreAPIController::class, 'store']);
        Route::put('/{id}', [GenreAPIController::class, 'update']);
        Route::delete('/{id}', [GenreAPIController::class, 'destroy']);
    });

    Route::prefix('books')->group(function () {
        Route::get('/', [BookAPIController::class, 'index']);
        //   Route::get("{id}", [BookAPIController::class, 'show']);
        //   Route::post('/', [BookAPIController::class, 'store']);
        //   Route::put('/{id}', [BookAPIController::class, 'update']);
        //   Route::delete('/{id}', [BookAPIController::class, 'destroy']);
    });

    /* Logout a logged-in user */
    Route::get('logout', [AuthAPIController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
