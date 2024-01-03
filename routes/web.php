<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KostanController;
use App\Http\Controllers\PasswordController;
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
    Route::post('/logout', 'logout')->name('logout');
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


    Route::get('/profil', 'profil')->name('profil');
    Route::get('/myRoom', 'myRoom')->name('myRoom');
    Route::post('/editProfil', 'editProfil')->name('editProfil');
});

Route::controller(KostanController::class)->middleware('auth')->group(function () {
    Route::get('/manageKostan', 'index')->name('manageKostan');
    Route::post('/isiKamar', 'isiKamar')->name('isiKamar');
    Route::post('/kosongKamar', 'kosongKamar')->name('kosongKamar');
    Route::post('/bayarkost', 'bayarkost')->name('bayarkost');
    Route::post('/successPayment', 'successPayment')->name('successPayment');
});

Route::controller(PasswordController::class)->middleware('auth')->group(function () {
    Route::get('/changePassword', 'index')->name('changePassword');
    Route::post('/change', 'change')->name('change');
});
