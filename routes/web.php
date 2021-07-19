<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

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

Route::get('/{user}', [AccountController::class, 'index']);
Route::get('/transfer', [AccountController::class, 'transfer']);
Route::get('/transfer-my-account', [AccountController::class, 'transferToMyAccount']);
Route::post('/save-transfer', [AccountController::class, 'saveTransfer']);
Route::get('/{account}', [AccountController::class, 'showAccount']);
Route::get('/cancel/{transfer}', [AccountController::class, 'cancelTransfer']);

Route::get('/order-records', [AccountController::class, 'orderRecords']);
Route::post('/records', [AccountController::class, 'showRecords']);
Route::get('/add-account', [AccountController::class, 'addAccount']);
Route::get('/my-info', [AccountController::class, 'myInfo']);

Auth::routes();
Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
