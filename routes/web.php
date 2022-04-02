<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Webcheckout\WebcheckoutController;

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
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['role:Admin']], function () {
    Route::resource('users', UserController::class)->middleware(['auth', 'verified']);
    Route::resource('products',ProductController::class,[
        'except' => ['show']]
    )->middleware(['auth','verified']);

});

Route::post('/cart', [CartController::class, 'store'])
      ->name('cart.store')->middleware((['auth','verified']));
Route::get('/cart-content', [CartController::class, 'index'])
      ->name('cart-content.index')->middleware((['auth','verified']));
Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::resource('/webcheckout',WebcheckoutController::class);

Route::get('/products/show', [ProductController::class, 'show'])->name('products.show')->middleware((['auth','verified']));

Route::resource('/invoice',InvoiceController::class);


require __DIR__.'/auth.php';
