<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\SettingsController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Aracın giriş, çıkış ve park ücreti hesaplama rotaları
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
Route::post('/vehicles/{vehicle}/checkout', [VehicleController::class, 'checkout'])->name('vehicles.checkout');

// Arac tipleri ile ilgili rotalar
Route::post('/types', [TypeController::class, 'store'])->name('types.store');
Route::get('/types/{id}', [TypeController::class, 'show']);

Route::delete('/types/{type}', [TypeController::class, 'destroy'])->name('types.destroy');

Route::get('/settings', [SettingsController::class, 'index'])->name('settings');


