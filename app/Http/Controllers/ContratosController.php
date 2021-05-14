<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContratoRequest;
use App\Http\Requests\UpdateContratoRequest;
use App\Models\ClienteVendedor;
use App\Models\Contrato;
use App\Models\User;
use App\Http\Middleware\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\DB;

class ContratosController extends Controller {

    public function index() {
        abort_if(Gate::todoMundo(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contratos = Contrato::paginate(10);
        $contratoCliente = $this->contratosCliente('contratos');
        $contratoAcessor = $this->contratosAcessor('contratos');
        $userRole = User::find(1);
        return view('contratos.index', compact(['contratos','contratoAcessor', 'contratoCliente', 'userRole']));
    }

    public function create() {
        abort_if(Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $userRole = User::find(1);
        $user = ClienteVendedor::where('vendedor_id', auth()->user()->id)->get();
        $id[] = '';
        $i = 0;
        foreach ($user as $u) {
            $id[$i] =  $u->cliente_id;
            $i++; 
        }
        $clientes = User::whereIn('id', $id)->get();
        $todosClientes = User::join('role_user', 'users.id', 'role_user.user_id')->where('role_user.role_id', 2)->get();

        $acessores = $this->getAcessores();
        return view('contratos.create', compact(['clientes', 'acessores', 'todosClientes', 'userRole']));
    }

    public function store(StoreContratoRequest $request) {
        abort_if(Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contrato = Contrato::create($request->validated());
        $contrato->cliente_vendedor_id = $request->cvId();
        $contrato->save();
        $request->validate([
            'file_upload_contrato' => '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $this->upload($request, 'upload_contrato', 'file_upload_contrato', $contrato->id);
        
        return redirect()->route('contratos.index');
    }

    public function show(Contrato $contrato) {
        abort_if(Gate::todoMundo(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $checkVendedor = $this->contratoPertenceAoVendedor('contratos', $contrato->id);
        $checkCliente = $this->contratoPertenceAoCliente('contratos', $contrato->id);
        $checkAcessor = $this->contratoPertenceAoAcessor($contrato->acessor_id);
        if (!$checkAcessor)
            abort_if((empty($checkCliente->all()) && Gate::vendedor()), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $userRole = User::find(1);
        $uploads = $contrato->uploads();
        $upload = $uploads->all();
        return view('contratos.show', compact(['contrato', 'userRole', 'upload']));
    }
    
    public function edit(Contrato $contrato) {
        abort_if(Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $check = $this->contratoPertenceAoVendedor('contratos', $contrato->id);
        if(!User::isAdmin())
            abort_if(empty($check->all()), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $acessores = $this->getAcessores();
        $uploads = $contrato->uploads();
        $upload = $uploads->all();
        return view('contratos.edit', compact(['contrato','acessores', 'upload']));
    }

    public function update(UpdateContratoRequest $request, Contrato $contrato) {
        abort_if(Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $check = $this->contratoPertenceAoVendedor('contratos', $contrato->id);
        abort_if(empty($check->all()), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // dd($contrato->update($request->validated()));
        $request->validate([
            'file_upload_contrato' => '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $uploadsCheck = $this->upload($request, 'upload_contrato', 'file_upload_contrato', $contrato->id);
        // dd($uploadsCheck);
        return redirect()->route('contratos.show', $contrato);
    }

    public function destroy(Contrato $contrato) {
        abort_if(Gate::vendedor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $check = $this->contratoPertenceAoVendedor('contratos', $contrato->id);
        if (!User::isAdmin())
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
