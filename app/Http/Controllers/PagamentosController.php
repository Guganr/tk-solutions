<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePagamentoRequest;
use App\Http\Requests\UpdatePagamentoRequest;
use App\Models\Contrato;
use App\Models\User;
use App\Models\Pagamento;
use App\Http\Middleware\Gate;
use Symfony\Component\HttpFoundation\Response;
use \Datetime;
use \DateInterval;
use \DatePeriod;

class PagamentosController extends Controller {

    public function create($id) {
        
        if(User::isAdmin()) {
            $contrato = Contrato::find($id)->load('pagamentos');
            $datas_validas = $this->getDatasValidas($contrato);
            return view('pagamentos.create', compact(['datas_validas', 'contrato']));
        }
        abort_if(Gate::vendedorAcessor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contrato = Contrato::find($id)->load('pagamentos');
        $checkVendedor = $this->contratoPertenceAoVendedor('contratos', $contrato->id);
        $checkAcessor = $this->contratoPertenceAoAcessor($contrato->acessor_id);
        abort_if(empty($checkVendedor->all()) && !$checkAcessor, Response::HTTP_FORBIDDEN, '403 Forbidden');
        $datas_validas = $this->getDatasValidas($contrato);
        return view('pagamentos.create', compact(['datas_validas', 'contrato']));
    }

    public function store(StorePagamentoRequest $request) {
        // abort_if(Gate::vendedorAcessor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pagamento = Pagamento::create($request->validated());
        return redirect()->route('pagamentoCreate', ['pagamentoId' => $request->contrato_id, 'message' => 'Pagamento criado com sucesso']);
    }

    public function show($id) {
        $contrato = Contrato::find($id);
        $checkVendedor = $this->contratoPertenceAoVendedor('contratos', $contrato->id);
        $checkCliente = $this->contratoPertenceAoCliente('contratos', $contrato->id);
        $checkAcessor = $this->contratoPertenceAoAcessor($contrato->acessor_id);
        if (!$checkAcessor)
            abort_if((empty($checkCliente->all()) && Gate::vendedor()), Response::HTTP_FORBIDDEN, '403 Forbidden');
         
        $contrato->load('pagamentos');
        $pagamentos = $contrato->pagamentos;
        $userRole = User::find(1);
        return view('pagamentos.show', compact(['contrato','pagamentos', 'userRole']));
    }

    public function edit($id)
    {
        if (User::isAdmin()) {
            $contrato = Contrato::find($id);$contrato->load('pagamentos');
            $pagamentos = $contrato->pagamentos;
            return view('pagamentos.edit', compact(['contrato', 'pagamentos']));
        }
        // abort_if(Gate::vendedorAcessor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contrato = Contrato::find($id);
        $checkVendedor = $this->contratoPertenceAoVendedor('contratos', $contrato->id);
        $checkAcessor = $this->contratoPertenceAoAcessor($contrato->acessor_id);
        abort_if(empty($checkVendedor->all()) && !$checkAcessor, Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contrato->load('pagamentos');
        $pagamentos = $contrato->pagamentos;
        return view('pagamentos.edit', compact(['contrato', 'pagamentos']));
    }

    public function update(UpdatePagamentoRequest $request, $id) {
        // abort_if(Gate::vendedorAcessor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pagamento = [
            "valor" => $request->valor,
        ];
        Pagamento::where('id', $request->id)->update($pagamento);
        return redirect()->route('pagamentoEdit', ['pagamentoId' => $request->contrato_id, 'message' => 'Pagamento criado com sucesso']);
    }

    public function getDatasValidas($contrato) {
        $data_inicio_vigencia    = new DateTime($contrato->data_inicio_vigencia);
        $dia_atual      = new DateTime(date("Y-m-d"));
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($data_inicio_vigencia, $interval, $dia_atual);
        return $this->geraDatasValidas($period, $contrato->pagamentos);
    }

    public function geraDatasValidas($period, $pagamentos) {
        $datas_validas[] = '';
        $i = 0;
        $check = true;
        foreach ($period as $dt) {
            foreach ($pagamentos as $r) {
                if ($dt->format('mY') == $r->mes_referencia || in_array($dt->format('mY'), $datas_validas)) {
                    $check = false;
                }
            }
            if ($check) {
                $datas_validas[$i] =  $dt->format('mY');
                $i++;
            }
            $check = true;
        }
        return $datas_validas;
    }
}
