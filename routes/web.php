<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('contratos', 'App\Http\Controllers\ContratosController');
    Route::resource('users', \App\Http\Controllers\UsersController::class);
    Route::resource('rendimentos', \App\Http\Controllers\RendimentosController::class);
    Route::get('rendimentos/create/{contratoId}', '\App\Http\Controllers\RendimentosController@create')->name('rendimentoCreate');
    Route::get('rendimentos/edit/{contratoId}', '\App\Http\Controllers\RendimentosController@edit')->name('rendimentoEdit');
    Route::resource('alertas', \App\Http\Controllers\AlertasController::class);
    Route::get('alertas/create/{contratoId}', '\App\Http\Controllers\AlertasController@create')->name('alertaCreate');
    Route::get('alertas/edit/{contratoId}', '\App\Http\Controllers\AlertasController@edit')->name('alertaEdit');
});
