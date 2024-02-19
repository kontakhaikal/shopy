<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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


Route::get('/login', fn () => Inertia::render('Login'))->name('login');
Route::post('/login', [SessionController::class, 'login']);

Route::get('/register', [CustomerController::class, 'create']);
Route::post('/register', [CustomerController::class, 'store']);

Route::get('/', [HomeController::class, 'show']);

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/cart', [CartController::class, 'show'])->name('cart');
    Route::get('/checkout', [OrderController::class, 'cachePrepare']);
    Route::post('/checkout', [OrderController::class, 'prepare']);

    Route::post('/cart/items', [CartController::class, 'storeItem']);
});
