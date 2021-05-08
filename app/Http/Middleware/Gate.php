<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Gate as GateContract;

class Gate extends GateContract {

    public static function admin()
    {
        return !Gate::check('adm_access');
    }

    public static function vendedor()
    {
        return !Gate::check(['vendedor_access']);
    }

    public static function vendedorAcessor()
    {
        return !Gate::check(['acessor_access']);
    }

    public static function cliente()
    {
        return !Gate::check(['cliente_access']);
    }

    public static function todoMundo()
    {
        return !Gate::check(['cliente_access']) && !Gate::check(['acessor_access']);
    }
}
