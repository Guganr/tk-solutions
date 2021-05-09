<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlertaRequest;
use App\Models\Contrato;
use App\Models\Alerta;
use App\Http\Middleware\Gate;
use Symfony\Component\HttpFoundation\Response;

class AlertasController extends Controller {

    public function create($id) {
        abort_if(Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contrato = Contrato::find($id)->load('alertas');
        $checkVendedor = $this->contratoPertenceAoVendedor('contratos', $contrato->id);
        abort_if(empty($checkVendedor->all()) || $this->isAdmin(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('alertas.create', compact(['contrato']));
    }

    public function store(StoreAlertaRequest $request) {
        abort_if(Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $alerta = Alerta::create($request->validated());
        return redirect()->route('alertaCreate', ['contratoId' => $request->contrato_id, 'message' => 'alerta criado com sucesso']);
    }

    public function show($id) {
        abort_if(Gate::clienteVendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contrato = Contrato::find($id);
        $checkVendedor = $this->contratoPertenceAoVendedor('contratos', $contrato->id);
        $checkCliente = $this->contratoPertenceAoCliente('contratos', $contrato->id);
        $checkAcessor = $this->contratoPertenceAoAcessor($contrato->acessor_id);
        abort_if(empty($checkVendedor->all() || $checkCliente->all()) || $checkAcessor || $this->isAdmin(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contrato->load('alertas');
        $alertas = $contrato->alertas;
        return view('alertas.show', compact(['contrato', 'alertas']));
    }
}
