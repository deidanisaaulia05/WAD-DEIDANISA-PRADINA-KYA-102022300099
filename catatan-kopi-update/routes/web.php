<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KopiController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('kopi', KopiController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
