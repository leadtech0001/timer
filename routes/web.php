<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimerController;
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
