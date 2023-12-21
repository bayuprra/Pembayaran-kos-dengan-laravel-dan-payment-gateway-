<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PenyewaController;

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

Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'login')->name('login');
    Route::get('/login', 'login');
    Route::post('/login', 'authentikasi');
});

Route::controller(DashboardController::class)->middleware('auth')->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
});

Route::controller(KamarController::class)->middleware('auth')->group(function () {
    Route::get('/manageKamar', 'index')->name('manageKamar');
    Route::post('/addKamar', 'store')->name('addKamar');
    Route::post('/updateKamar', 'update')->name('updateKamar');
    Route::post('/deleteKamar', 'delete')->name('deleteKamar');
});

Route::controller(PenyewaController::class)->middleware('auth')->group(function () {
    Route::get('/managePenyewa', 'index')->name('managePenyewa');
    Route::post('/addPenyewa', 'store')->name('addPenyewa');
    Route::post('/updatePenyewa', 'update')->name('updatePenyewa');
    Route::post('/deletePenyewa', 'delete')->name('deletePenyewa');
});
