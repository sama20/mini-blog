<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
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

Route::get('/all',fn()=>'this is all');

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('me', 'me');
});

Route::controller(PostController::class)->group(function () {
    Route::get('posts', 'index');
    Route::post('posts', 'store');
    Route::get('posts/{post}', 'show');
    Route::put('posts/{post}', 'update');
    Route::delete('posts/{post}', 'destroy');
});

Route::controller(CommentController::class)->group(function () {
    Route::get('comments', 'index');
    Route::get('comments/{comment}', 'show');
    Route::post('comments', 'store');
    Route::put('comments/{comment}', 'update');
    Route::delete('comments/{comment}', 'destroy');
});

Route::controller(\App\Http\Controllers\ReactionController::class)->group(function () {
    Route::get('reactions', 'index');
    Route::get('reactions/{comment}', 'show');
    Route::post('reactions', 'store');
    Route::put('reactions/{comment}', 'update');
    Route::delete('reactions/{comment}', 'destroy');
});
