<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function teste($tabela, $tabela_id)
    {

        return DB::table($tabela)
            ->join('cliente_vendedor', $tabela . '.cliente_vendedor_id', '=', 'cliente_vendedor.id')
            ->where('cliente_vendedor.cliente_id', '=', auth()->user()->id)
            ->where($tabela.'.id', '=', $tabela_id)
            ->select($tabela . '.*')
            ->get();
    }

    public function goku($tabela) {

        return DB::table($tabela)
        ->join('cliente_vendedor', $tabela.'.cliente_vendedor_id', '=', 'cliente_vendedor.id')
        ->where('cliente_vendedor.cliente_id', '=', auth()->user()->id)
            ->select($tabela.'.*')
            ->get();
    }
}
