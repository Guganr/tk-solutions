<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRendimentoRequest;
use App\Http\Requests\UpdateRendimentoRequest;
use App\Models\Contrato;
use App\Models\Rendimento;
use App\Http\Middleware\Gate;
use Symfony\Component\HttpFoundation\Response;
use \Datetime;
use \DateInterval;
use \DatePeriod;

class RendimentosController extends Controller {

    public function create($id) {
        abort_if(Gate::vendedorAcessor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contrato = Contrato::find($id)->load('rendimentos');
        $datas_validas = $this->getDatasValidas($contrato);
        return view('rendimentos.create', compact(['datas_validas', 'contrato']));
    }

    public function store(StoreRendimentoRequest $request) {
        abort_if(Gate::vendedorAcessor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $rendimento = Rendimento::create($request->validated());abort_if(Gate::denies(['vendedor_access', 'acessor_access']), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return redirect()->route('rendimentoCreate', ['contratoId' => $request->contrato_id, 'message' => 'Rendimento criado com sucesso']);
    }

    public function show($id) {
        abort_if(Gate::todoMundo(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contrato = Contrato::find($id);
        $contrato->load('rendimentos');
        $rendimentos = $contrato->rendimentos;
        return view('rendimentos.show', compact(['contrato', 'rendimentos']));

    }

    public function edit($id) {
        abort_if(Gate::vendedorAcessor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contrato = Contrato::find($id);
        $contrato->load('rendimentos');
        $rendimentos = $contrato->rendimentos;
        return view('rendimentos.edit', compact(['contrato', 'rendimentos']));
    }

    public function update(UpdateRendimentoRequest $request, $id) {
        abort_if(Gate::vendedorAcessor(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $rendimento = [
            "valor" => $request->valor,
        ];
        Rendimento::where('id', $request->id)->update($rendimento);
        return redirect()->route('rendimentoEdit', ['contratoId' => $request->contrato_id, 'message' => 'Rendimento criado com sucesso']);
    }

    public function getDatasValidas($contrato) {
        $data_inicio_vigencia    = new DateTime($contrato->data_inicio_vigencia);
        $dia_atual      = new DateTime(date("Y-m-d"));
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($data_inicio_vigencia, $interval, $dia_atual);
        return $this->geraDatasValidas($period, $contrato->rendimentos);
    }
    
    public function geraDatasValidas($period, $rendimentos) {
        $datas_validas[] = '';
        $i = 0;
        $check = true;
        foreach ($period as $dt) {
            foreach ($rendimentos as $r) {
                if($dt->format('mY') == $r->mes_referencia || in_array($dt->format('mY'), $datas_validas)){
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
