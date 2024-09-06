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

Route::get('/', function(){
    return 'Test';
});
Route::get('welcome', [MahaController::class, 'welcome'])->name('welcome');
Route::get('register-form', [MahaController::class, 'register'])->name('register-form');
Route::get('qrcode', [MahaController::class, 'qrcode'])->name('qrcode');
