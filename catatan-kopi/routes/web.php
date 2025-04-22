<?php

use App\Http\Controllers\KopiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kopi', [KopiController::class, 'index']);