<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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


Route::middleware("auth:sanctum")->group(function () {
    Route::prefix("/posts")->group(function () {
        Route::get('/', [PostController::class, "index"]);
        Route::post('/', [PostController::class, "create"]);
        Route::delete('/{id}', [PostController::class, "remove"]);
        Route::put('/togglelike/{id}', [PostController::class, "toggleLike"]);
        Route::post('/comment/{id}', [PostController::class, "addComment"]);
        Route::delete('{idPost}/comment/{idComment}', [PostController::class, "removeComment"]);
    });
});


Route::prefix("/users")->group(function () {
    Route::post('/login', [UserController::class, "login"]);
    Route::post('/register', [UserController::class, "register"]);
});
