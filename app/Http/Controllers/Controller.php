<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function contratoPertenceAoCliente($tabela, $tabela_id) {
        return DB::table($tabela)
            ->join('cliente_vendedor', $tabela . '.cliente_vendedor_id', '=', 'cliente_vendedor.id')
            ->where('cliente_vendedor.cliente_id', '=', auth()->user()->id)
            ->where($tabela.'.id', '=', $tabela_id)
            ->select($tabela . '.*')
            ->get();
    }

    public function contratoPertenceAoVendedor($tabela, $tabela_id) {
        return DB::table($tabela)
            ->join('cliente_vendedor', $tabela . '.cliente_vendedor_id', '=', 'cliente_vendedor.id')
            ->where('cliente_vendedor.vendedor_id', '=', auth()->user()->id)
            ->where($tabela.'.id', '=', $tabela_id)
            ->select($tabela . '.*')
            ->get();
    }

    public function contratosCliente($tabela) {
        return DB::table($tabela)
        ->join('cliente_vendedor', $tabela.'.cliente_vendedor_id', '=', 'cliente_vendedor.id')
        ->where('cliente_vendedor.cliente_id', '=', auth()->user()->id)
        ->select($tabela.'.*')
        ->get();
    }

    public function ticketsCliente() {
        return Ticket::where('user_id', '=', auth()->user()->id)->allowedFilters('status')
                ->paginate(10);
    }

    public function ticketPertenceAoCliente()
    {
        return Ticket::where('user_id', '=', auth()->user()->id);
    }

    public function ticketPertenceAoVendedor() {
        return Ticket::where('responsavel', '=', auth()->user()->id);
    }

    public function contratoPertenceAoAcessor($id) {
        return auth()->user()->id == $id;
    }
    
    public function isAdmin() {
        return !auth()->user()->getUserRole()->get()[0]->id == 1;
    }
    // public function teste($tabela) {
    //     auth()->user()->load('roles');
    //     dd(auth()->user());
    // }


}
