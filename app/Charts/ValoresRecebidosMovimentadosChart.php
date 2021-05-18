<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Pagamento;
use App\Models\Contrato;

class ValoresRecebidosMovimentadosChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $c = new Contrato;
        $p = new Pagamento;
        return Chartisan::build()
            ->labels(['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Novembro', 'Dezembro'])
            ->dataset('Valores Recebidos', [$c->getValorRecebido(1)[0]->valor, $c->getValorRecebido(2)[0]->valor, $c->getValorRecebido(3)[0]->valor, $c->getValorRecebido(4)[0]->valor, $c->getValorRecebido(5)[0]->valor, $c->getValorRecebido(6)[0]->valor, $c->getValorRecebido(7)[0]->valor, $c->getValorRecebido(8)[0]->valor, $c->getValorRecebido(9)[0]->valor, $c->getValorRecebido(10)[0]->valor, $c->getValorRecebido(11)[0]->valor, $c->getValorRecebido(12)])
            ->dataset('Valores Movimentados', [$p->getValorMovimentado(1)[0]->valor, $p->getValorMovimentado(2)[0]->valor, $p->getValorMovimentado(3)[0]->valor, $p->getValorMovimentado(4)[0]->valor, $p->getValorMovimentado(5)[0]->valor, $p->getValorMovimentado(6)[0]->valor, $p->getValorMovimentado(7)[0]->valor, $p->getValorMovimentado(8)[0]->valor, $p->getValorMovimentado(9)[0]->valor, $p->getValorMovimentado(10)[0]->valor, $p->getValorMovimentado(11)[0]->valor, $p->getValorMovimentado(12)]);
    }
}