<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Contrato;

class ValoresRecebidosChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $c = new Contrato;
        return Chartisan::build()
            ->labels(['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Novembro', 'Dezembro'])
            ->dataset('Valores Recebidos', [$c->getValorRecebido(1)[0]->valor, $c->getValorRecebido(2)[0]->valor, $c->getValorRecebido(3)[0]->valor, $c->getValorRecebido(4)[0]->valor, $c->getValorRecebido(5)[0]->valor, $c->getValorRecebido(6)[0]->valor, $c->getValorRecebido(7)[0]->valor, $c->getValorRecebido(8)[0]->valor, $c->getValorRecebido(9)[0]->valor, $c->getValorRecebido(10)[0]->valor, $c->getValorRecebido(11)[0]->valor, $c->getValorRecebido(12)]);
    }
}