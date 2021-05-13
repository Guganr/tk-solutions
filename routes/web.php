<?php

use Illuminate\Support\Facades\Route;

use App\Models\Contrato;
use App\Models\ClienteVendedor;
use App\Models\User;
use Spatie\QueryBuilder\QueryBuilder;


function getContratosDashboard(){
    $cliente = null;
    $vendedor = null;
    $contratos = null;
    $user = ClienteVendedor::where('cliente_id', auth()->user()->id)->first();
    if (null !== $user) {
        $user->refresh();
        $cliente = User::where('id', $user->cliente_id)->first();
        $cliente->refresh();
    } else {
        $user = ClienteVendedor::where('vendedor_id', auth()->user()->id)->first();
        if (null !== $user) {
            $user->refresh();
            $vendedor = User::where('id', $user->cliente_id)->first();
            $vendedor->refresh();
        }
    }

    if (null !== $cliente) {
        $u = ClienteVendedor::where('cliente_id', auth()->user()->id)->get();
        $id[] = '';
        $i = 0;
        foreach ($u as $u) {
            $id[$i] =  $u->id;
            $i++;
        }
        $contratos = Contrato::where('cliente_vendedor_id', $id)->paginate(10)->get()->load('rendimentos');
    } else if (null !== $vendedor) {

        $u = ClienteVendedor::where('vendedor_id', auth()->user()->id)->get();
        $id[] = '';
        $i = 0;
        foreach ($u as $u) {
            $id[$i] =  $u->id;
            $i++;
        }
        $contratos = Contrato::where('cliente_vendedor_id', $id)->get()->load('rendimentos');
    } else {
        $contratos = Contrato::paginate(10);
    }
    return $contratos;
} 

function getUsuariosDashboard(){
    $cliente = null;
    $vendedor = null;
    $user = ClienteVendedor::where('cliente_id', auth()->user()->id)->first();
    if (null !== $user) {
        return null;
    } else if(auth()->user()->isAdmin()){

        $users = QueryBuilder::for(User::class)
            ->allowedIncludes('roles')
            ->paginate(10);
        return $users;
    } else {
        $u = ClienteVendedor::where('vendedor_id', auth()->user()->id)->get();
        $id[] = '';
        $i = 0;
        foreach ($u as $u) {
            $id[$i] =  $u->cliente_id;
            $i++;
        }
        $users = User::where('id', $id)->get();
        return $users;
    } 
} 

Route::get('/', function () {
    return view('auth/login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    // $contratos = getContratosDashboard();
    // $users = getUsuariosDashboard();
    return view('dashboard');
    // return view('dashboard', compact(['contratos', 'users']));
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
