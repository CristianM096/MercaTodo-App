<?php

use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Invoice\InvoiceController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Webcheckout\WebcheckoutController;
use App\Http\Controllers\Product\ProductClientController;

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
})->middleware(['auth', 'verified','role:Client|Admin','checkUser'])->name('dashboard');

Route::group(['middleware' => ['role:Admin']], function () {
    Route::resource('users', UserController::class)->middleware(['auth', 'verified']);
    Route::resource(
        'products',
        ProductController::class,
        [
        'except' => ['show']]
    )->middleware(['auth','verified']);
});


Route::post('/cart', [CartController::class, 'store'])
      ->name('cart.store')->middleware((['auth','verified','role:Client|Admin']));
Route::get('/cart-content', [CartController::class, 'index'])
      ->name('cart-content.index')->middleware((['auth','verified','role:Client|Admin']));
Route::delete('/cart', [CartController::class, 'destroy'])->name('cart.destroy')->middleware((['auth','verified','role:Client|Admin']));
Route::put('/cart/update', [CartController::class,'update'])->name('cart.update')->middleware((['auth','verified','role:Client|Admin']));
Route::get('/cart/delete{rowId}', [CartController::class,'remove'])->name('cart.delete')->middleware((['auth','verified','role:Client|Admin']));

Route::resource('/webcheckout', WebcheckoutController::class)->middleware((['auth','verified','role:Client|Admin']));

Route::get('/dashboard', [ProductClientController::class, 'index'])->name('productsClient.index')->middleware((['auth','verified','role:Client|Admin']));

Route::post('/invoice/store', [InvoiceController::class,'store'])->name('invoice.store')->middleware((['auth','verified','role:Client|Admin']));
Route::get('/invoice', [InvoiceController::class,'index'])->name('invoice.index')->middleware((['auth','verified','role:Client|Admin']));
Route::get('/invoice/show{invoice}', [InvoiceController::class,'show'])->name('invoice.show')->middleware((['auth','verified','role:Client|Admin']));

require __DIR__.'/auth.php';
