<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Contrato;

class ContratoChart extends BaseChart
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
            ->labels(['Janeiro','Fevereiro','Março','Abril', 'Maio','Junho','Julho','Agosto','Setembro','Novembro', 'Dezembro'])
            ->dataset('Sample', [$c->getContratosAssinados(1), $c->getContratosAssinados(2), $c->getContratosAssinados(3), $c->getContratosAssinados(4), $c->getContratosAssinados(5), $c->getContratosAssinados(6), $c->getContratosAssinados(7), $c->getContratosAssinados(8), $c->getContratosAssinados(9), $c->getContratosAssinados(10), $c->getContratosAssinados(11), $c->getContratosAssinados(12)]);
    }
}