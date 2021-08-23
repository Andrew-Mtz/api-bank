<?php

use App\Http\Controllers\AccountController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/accounts' , [AccountController::class, 'index']);

Route::post('/accounts' , [AccountController::class, 'store']);

Route::post('/accounts' , [AccountController::class, 'update']); */

Route::resource('account', AccountController::class);
