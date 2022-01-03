<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
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

//Route::middleware(['auth', 'verified'])->get('/users/index', [UserController::class, 'index'])->name('users.index');
//Route::middleware(['auth', 'verified'])->get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
//Route::middleware(['auth', 'verified'])->post('/users/update', [UserController::class, 'update'])->name('users.update');
Route::group(['middleware' => ['role:Admin']], function () {
    Route::resource('users', UserController::class)->middleware(['auth', 'verified']);
});
require __DIR__.'/auth.php';
