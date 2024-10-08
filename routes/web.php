<?php

use App\Http\Controllers\Apps\MahaOrganizerController;
use App\Http\Controllers\Apps\MahaVisitorOrganizerController;
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

Route::get('states', [MahaController::class, 'state'])->name('maha.state');
Route::post('check-ic-number', [MahaController::class, 'checkIcNumber'])->name('check.ic_number');

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [MahaOrganizerController::class, 'home'])->name('maha.home');
    Route::resource('visitor', MahaVisitorOrganizerController::class);
    Route::get('lucky-draw', [MahaOrganizerController::class, 'luckyDraw'])->name('maha.lucky.draw');
    Route::get('overwrite', [MahaOrganizerController::class, 'luckyDrawOverwrite'])->name('maha.lucky.draw.overwrite');
    Route::get('lucky-draw-name', [MahaOrganizerController::class, 'luckyDrawName'])->name('maha.lucky.draw.name');
    Route::post('daily-summaries', [MahaOrganizerController::class, 'dailySummaries'])->name('maha.daily.summaries');
    Route::post('state-data', [MahaOrganizerController::class, 'getStateData'])->name('maha.state.data');
    Route::post('gender-data', [MahaOrganizerController::class, 'getGenderData'])->name('maha.gender.data');
    Route::post('total-visitor-total', [MahaOrganizerController::class, 'totalVisitorTotal'])->name('maha.visitor.total');
    Route::post('total-visitor-zone', [MahaOrganizerController::class, 'totalVisitorZone'])->name('maha.visitor.zone');
});



