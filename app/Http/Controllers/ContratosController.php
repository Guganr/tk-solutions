<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContratoRequest;
use App\Http\Requests\UpdateContratoRequest;
use App\Models\ClienteVendedor;
use App\Models\Contrato;
use App\Models\User;
use App\Http\Middleware\Gate;
use Symfony\Component\HttpFoundation\Response;

class ContratosController extends Controller {

    public function index() {
        abort_if(Gate::todoMundo(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contratos = Contrato::all();

        $contratoCliente = $this->goku('contratos');
        return view('contratos.index', compact(['contratos', 'contratoCliente']));
    }

    public function create() {
        abort_if(Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = ClienteVendedor::where('vendedor_id', auth()->user()->id)->get();
        $id[] = '';
        $i = 0;
        foreach ($user as $u) {
            $id[$i] =  $u->cliente_id;
            $i++; 
        }

        $clientes = User::whereIn('id', $id)->get();
        return view('contratos.create', compact('clientes'));
    }

    public function store(StoreContratoRequest $request) {
        abort_if(Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contrato = Contrato::create($request->validated());
        $contrato->cliente_vendedor_id = $request->cvId();
        $contrato->save();
        return redirect()->route('contratos.index');
    }

    public function show(Contrato $contrato) {
        abort_if(Gate::todoMundo(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $check = $this->teste('contratos', $contrato->id);
        abort_if(empty($check->all()), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('contratos.show', compact('contrato'));
    }
    
    public function edit(Contrato $contrato) {
        abort_if(Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('contratos.edit', compact('contrato'));
    }

    public function update(UpdateContratoRequest $request, Contrato $contrato) {
        abort_if(Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contrato->update($request->validated());
        return redirect()->route('contratos.index');
    }

    public function destroy(Contrato $contrato) {
        abort_if(Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contrato->delete();
        return redirect()->route('contratos.index');
    }
}
