<?php

use App\Http\Controllers\Maha\MahaController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MahaController::class, 'welcome'])->name('maha.welcome');
Route::get('register-form', [MahaController::class, 'register'])->name('maha.register-form');
Route::post('register', [MahaController::class, 'registerPost'])->name('maha.register');
