<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redis;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/novel/editor', function () {
    return Inertia::render('NovelEditor');
})->middleware(['auth', 'verified'])->name('novelEditor');

Route::post('/novels', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('novelSave');

// Route::get('/test', function(){
//     return Redis::incr('visit');
// });

require __DIR__.'/auth.php'; /* auth関係のルーティングを呼び出し(基本はweb.php) */
