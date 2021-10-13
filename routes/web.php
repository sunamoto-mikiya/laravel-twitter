<?php

use Illuminate\Support\Facades\Route;
// ↓追加
use App\Http\Controllers\TweetController;
use App\Http\Controllers\FavoriteController;
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
// ↓追加
//Route::resource('tweet', TweetController::class);

//['middleware' => 'auth']で認証チェック
Route::group(['middleware' => 'auth'], function () {
    // ↓追加
    Route::post('tweet/{tweet}/favorites', [FavoriteController::class, 'store'])->name('favorites');
    // ↓追加
    Route::post('tweet/{tweet}/unfavorites', [FavoriteController::class, 'destroy'])->name('unfavorites');
    Route::get('/tweet/userpage', [TweetController::class, 'userdata'])->name('tweet.userpage');
    Route::get('/tweet/mypage', [TweetController::class, 'mydata'])->name('tweet.mypage');
    Route::resource('tweet', TweetController::class);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
