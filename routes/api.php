<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Route::prefix("/users")->group(function () {
    Route::post('/register', [UserController::class, "register"]);
    Route::post('/login', [UserController::class, "login"]);
});

Route::middleware("auth:sanctum")->group(function () {
    Route::prefix("/posts")->group(function () {
        Route::get('/', [PostController::class, "index"]);
        Route::post('/', [PostController::class, "create"]);
        Route::delete('/{id}', [PostController::class, "remove"]);

        Route::put('/togglelike/{id}', [PostController::class, "toggleLike"]);
        Route::put('/comment/{id}', [PostController::class, "addComment"]);
        Route::put('{idPPost}/comment/{idComment}', [PostController::class, "removeComment"]);
    });
});
