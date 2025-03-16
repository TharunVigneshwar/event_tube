<?php

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\VideoControllerHtmx;
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

Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirectToGoogle'])
    ->name('auth.google.redirect');

Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])
    ->name('auth.google.callback');

Route::get('video-api/{video}/like', [VideoControllerHtmx::class, 'like'])
    ->name('video-api.like');

Route::get('video-api/{video}/views', [VideoControllerHtmx::class, 'views'])->name('video-api.view');

Route::get('video-api/{event_id}/index', [VideoControllerHtmx::class, 'index'])
    ->name('video-api.index');
