<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContratoRequest;
use App\Http\Requests\UpdateContratoRequest;
use App\Models\ClienteVendedor;
use App\Models\Contrato;
use App\Models\User;
use App\Http\Middleware\Gate;
use Symfony\Component\HttpFoundation\Response;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\DB;

class ContratosController extends Controller {

    public function index() {
        abort_if(Gate::todoMundo(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contratos = Contrato::all();

        $contratoCliente = $this->contratosCliente('contratos');
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

        $clientes = User::where('id', $id)->get();

        $acessores = $this->getAcessores();
        return view('contratos.create', compact(['clientes', 'acessores']));
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
        $checkVendedor = $this->contratoPertenceAoVendedor('contratos', $contrato->id);
        $checkCliente = $this->contratoPertenceAoCliente('contratos', $contrato->id);
        $checkAcessor = $this->contratoPertenceAoAcessor($contrato->acessor_id);
        abort_if(empty($checkVendedor->all() || $checkCliente->all()) || $checkAcessor , Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('contratos.show', compact('contrato'));
    }
    
    public function edit(Contrato $contrato) {
        abort_if(Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $check = $this->contratoPertenceAoVendedor('contratos', $contrato->id);
        abort_if(empty($check->all()), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $acessores = $this->getAcessores();
        return view('contratos.edit', compact(['contrato', 'acessores']));
    }

    public function update(UpdateContratoRequest $request, Contrato $contrato) {
        abort_if(Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $check = $this->contratoPertenceAoVendedor('contratos', $contrato->id);
        abort_if(empty($check->all()), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contrato->update($request->validated());
        return redirect()->route('contratos.index');
    }

    public function destroy(Contrato $contrato) {
        abort_if(Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $check = $this->contratoPertenceAoVendedor('contratos', $contrato->id);
        abort_if(empty($check->all()), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contrato->delete();
        return redirect()->route('contratos.index');
    }
    public function getAcessores() {
        return DB::table('users')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('role_user.role_id', 4)
            ->select('users.id', 'users.name')
            ->get();
    }
}
