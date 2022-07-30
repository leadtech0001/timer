<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\movie\MovieController;
use App\Http\Controllers\movie\MovieLoginController;
use App\Http\Controllers\movie\MovieRegistController;
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

Route::get('/', function () {
    return view('timer');
});

// timer用
Route::get(
    '/timer',
    [TimerController::class, 'index']
)->name('timerIndex');

Route::post(
    '/resist',
    [TimerController::class, 'registTimer']
)->name('resist');

Route::post(
    '/same',
    [TimerController::class, 'sameTimer']
)->name('same');

//------------------------------------------------------------------

// laravel学習用 ログイン機能 メンバー登録
Route::get('/home', function () {
    return view('home');
});

Route::get(
    '/register',
    [TimerController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post(
    '/register',
    [TimerController::class, 'store'])
    ->middleware('guest');

Route::get(
    '/login',
    [LoginController::class, 'index'])
    ->middleware('guest')
    ->name('login');

Route::post(
    '/login',
    [LoginController::class, 'authenticate'])
    ->middleware('guest');

Route::get(
    '/logout',
    [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

//------------------------------------------------------------------

// laravel学習用 見たい映画一覧ページ
Route::get('/movie/movie-index', [MovieController::class, 'index'])
    ->name('movie-index');

// 検索
Route::post('/movie/movie-index', [MovieController::class, 'search'])
->name('movie-search');

// ログイン ログアウト
Route::get('/movie/movie-login', [MovieLoginController::class, 'index'])
    ->name('movie-login');

Route::post('/movie/movie-login', [MovieLoginController::class, 'authenticate'])
    ->name('movie-login');

Route::get('/movie/movie-login', [MovieLoginController::class, 'logout'])
    ->name('movie-logout');

// 会員登録
Route::get('/movie/movie-register', [MovieRegistController::class, 'create'])
->name('movie-register');

Route::post('/movie/movie-register', [MovieRegistController::class, 'store'])
->name('movie-register');

// 詳細
Route::get('/movie/movie-detail/{{id}}', [MovieController::class, 'detail'])
->name('movie-detail');

// 評価登録
Route::get('/movie/movie-evaluation/{{id}}', [MovieController::class, 'evaluation'])
->name('movie-evaluation');














//------------------------------------------------------------------
// laravelの関数であるページャーのテスト用
Route::get(
    '/user',
    [UserController::class, 'index']
)->name('index');