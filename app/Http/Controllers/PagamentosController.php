<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePagamentoRequest;
use App\Http\Requests\UpdatePagamentoRequest;
use App\Models\Contrato;
use App\Models\Pagamento;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use \Datetime;
use \DateInterval;
use \DatePeriod;

class PagamentosController extends Controller
{

    public function index()
    {
        //Pagamento
    }

    public function create($id)
    {
        abort_if(Gate::denies('vendedor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contrato = Contrato::find($id)->load('pagamentos');
        $datas_validas = $this->getDatasValidas($contrato);
        return view('pagamentos.create', compact(['datas_validas', 'contrato']));
    }

    public function store(StorePagamentoRequest $request)
    {
        $pagamento = Pagamento::create($request->validated());
        return redirect()->route('pagamentoCreate', ['pagamentoId' => $request->contrato_id, 'message' => 'Pagamento criado com sucesso']);
    }

    public function show($id)
    {
        abort_if(Gate::denies('vendedor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contrato = Contrato::find($id);
        $contrato->load('pagamentos');
        $pagamentos = $contrato->pagamentos;
        return view('pagamentos.show', compact(['contrato', 'pagamentos']));
    }

    public function edit($id)
    {
        abort_if(Gate::denies('vendedor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contrato = Contrato::find($id);
        $contrato->load('pagamentos');
        $pagamentos = $contrato->pagamentos;
        return view('pagamentos.edit', compact(['contrato', 'pagamentos']));
    }

    public function update(UpdatePagamentoRequest $request, $id)
    {
        $pagamento = [
            "valor" => $request->valor,
        ];
        Pagamento::where('id', $request->id)->update($pagamento);
        return redirect()->route('pagamentoEdit', ['pagamentoId' => $request->contrato_id, 'message' => 'Pagamento criado com sucesso']);
    }

    public function destroy($id)
    {
        //
    }
    public function getDatasValidas($contrato)
    {
        $data_inicio_vigencia    = new DateTime($contrato->data_inicio_vigencia);
        $dia_atual      = new DateTime(date("Y-m-d"));
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($data_inicio_vigencia, $interval, $dia_atual);
        return $this->geraDatasValidas($period, $contrato->pagamentos);
    }

    public function geraDatasValidas($period, $pagamentos)
    {
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