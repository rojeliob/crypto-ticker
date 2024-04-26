<?php

use App\Http\Controllers\CryptoTickerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/crypto-ticker', [CryptoTickerController::class, 'index'])->name('crypto-ticker');
