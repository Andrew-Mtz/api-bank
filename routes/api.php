<?php

use App\Http\Controllers\AccountController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

 Route::get('/account' , [AccountController::class, 'index']);

Route::post('/account' , [AccountController::class, 'store']);

Route::put('/account/deposito' , [AccountController::class, 'deposito']); 

Route::put('/account/retiro' , [AccountController::class, 'retiro']); 

Route::put('/account/transferencia' , [AccountController::class, 'transferencia']); 

//Route::resource('account', AccountController::class);
