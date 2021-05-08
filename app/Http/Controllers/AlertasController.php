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
        return view('alertas.create', compact(['contrato']));
    }

    public function store(StoreAlertaRequest $request) {
        abort_if(Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $alerta = Alerta::create($request->validated());
        return redirect()->route('alertaCreate', ['contratoId' => $request->contrato_id, 'message' => 'alerta criado com sucesso']);
    }

    public function show($id) {
        abort_if(Gate::todoMundo(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contrato = Contrato::find($id);
        $contrato->load('alertas');
        $alertas = $contrato->alertas;
        return view('alertas.show', compact(['contrato', 'alertas']));
    }
}
