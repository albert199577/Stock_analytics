<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\LineController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
    return view('welcome');
});

Route::resource('stock', StockController::class);

// Route::get('stock/csv/{stock_id}', [StockController::class, 'storeCsv'])->name('store.storeCsv');

Route::resource('search', SearchController::class)->middleware('auth');

Route::post('search/result', [SearchController::class, 'search'])->name('stock.search');

Route::prefix('line')->group(function () {
    Route::get('/login', [LineController::class, 'login'])->name('line.login');
    Route::get('/callback', [LineController::class, 'callback'])->name('line.callback');
});

Route::resource('admin', AdminController::class)->middleware('can:admin');

Auth::routes();

