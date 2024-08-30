<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsiController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});



Route::post('/usi', [UsiController::class, 'store'])->name('usi.store');
Route::post('/user', [UsiController::class, 'store2'])->name('usi.addUser');
 
Route::middleware('auth')->group(function () {
    Route::get('/usi', [UsiController::class, 'index'])->name('usi.index');
    Route::get('/user', [UsiController::class, 'index2'])->name('user.index');
});


Route::get('/transaction',[TransactionController::class,'index']);

Route::post('/transaction',[TransactionController::class,'getData'])->name('transaction.getData');


Route::get('login', [AuthController::class, 'login'])->name('login');

Route::post('login', [AuthController::class, 'loginAction'])->name('login.action');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');
