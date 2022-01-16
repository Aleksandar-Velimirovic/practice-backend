<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImageController;
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

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/file', [LoginController::class, 'test']);
Route::get('/profile-user', [ProfileController::class, 'getProfileByUser']);
Route::post('/profile-picture', [ProfileController::class, 'updateProfilePicture']);
Route::post('/add-image', [ImageController::class, 'store']);
Route::get('/images', [ImageController::class, 'getImagesByProfile']);
Route::post('/comment', [CommentController::class, 'store']);
Route::get('/popular-profiles', [ProfileController::class, 'getPopularProfiles']);
Route::get('/profile', [ProfileController::class, 'getProfile']);
Route::post('/follow-profile', [ProfileController::class, 'follow']);
Route::get('/is-following-profile', [ProfileController::class, 'isFollowing']);
