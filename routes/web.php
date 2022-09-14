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

Route::middleware('auth', 'verified')->group(function () {
// 小説一覧
Route::get('/novels', [NovelController::class, 'index'])
->name('novels');

// 新規小説執筆
Route::get('/novels/create', [NovelController::class, 'create'])
->name('novelCreate');

// 新規小説保存
Route::post('/novels/edit', [NovelController::class, 'store'])
->name('novelStore');

// 既存小説編集
Route::get('/novels/edit', [NovelController::class, 'edit'])
->name('novelEdit');

// 既存小説保存
Route::post('/novels/update', [NovelController::class, 'update'])
->name('novelUpdate');
});

require __DIR__.'/auth.php'; /* auth関係のルーティングを呼び出し(基本はweb.php) */
