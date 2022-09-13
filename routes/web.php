<?php

use App\Http\Controllers\NovelController;
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

// Route::get('/test', function(){
//     return Redis::incr('visit');
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// 小説一覧
Route::get('/novels', [NovelController::class, 'index'])
->middleware(['auth', 'verified'])->name('novels');

// 新規小説執筆
Route::get('/novels/create', [NovelController::class, 'create'])
->middleware(['auth', 'verified'])->name('novelCreate');

// 新規小説保存
Route::post('/novels/store', [NovelController::class, 'store'])
->middleware(['auth', 'verified'])->name('novelStore');

require __DIR__.'/auth.php'; /* auth関係のルーティングを呼び出し(基本はweb.php) */
