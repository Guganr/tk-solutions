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
    Route::resource('tickets', \App\Http\Controllers\TicketsController::class);
    Route::resource('rendimentos', \App\Http\Controllers\RendimentosController::class);
    Route::get('rendimentos/create/{contratoId}', '\App\Http\Controllers\RendimentosController@create')->name('rendimentoCreate');
    Route::get('rendimentos/edit/{contratoId}', '\App\Http\Controllers\RendimentosController@edit')->name('rendimentoEdit');
    Route::resource('pagamentos', \App\Http\Controllers\PagamentosController::class);
    Route::get('pagamentos/create/{pagamentoId}', '\App\Http\Controllers\PagamentosController@create')->name('pagamentoCreate');
    Route::get('pagamentos/edit/{pagamentoId}', '\App\Http\Controllers\PagamentosController@edit')->name('pagamentoEdit');
    Route::resource('alertas', \App\Http\Controllers\AlertasController::class);
    Route::get('alertas/create/{contratoId}', '\App\Http\Controllers\AlertasController@create')->name('alertaCreate');
    Route::get('alertas/edit/{contratoId}', '\App\Http\Controllers\AlertasController@edit')->name('alertaEdit');
    Route::resource('replicas', \App\Http\Controllers\ReplicasController::class);
    Route::get('replicas/create/{replicaId}', '\App\Http\Controllers\ReplicasController@create')->name('replicaCreate');
    Route::get('replicas/edit/{replicaId}', '\App\Http\Controllers\ReplicasController@edit')->name('replicaEdit');
});
