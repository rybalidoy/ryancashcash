<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
if(env("APP_ENV") === 'local') {
    sleep(1);
}


Route::any('/{any}', function() {
    return view('app');
})->where('any','.*')->name('/');
