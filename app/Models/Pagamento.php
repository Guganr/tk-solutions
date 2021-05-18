<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pagamento extends Model
{
    use HasFactory;
    protected  $primaryKey = 'id';
    protected $fillable = [
        'contrato_id',
        'valor',
        'mes_referencia'
    ];
    public function pagamentos() {
        return $this->hasOne(Contrato::class);
    }

    public function getValorMovimentado($mes)
    {

        $valor = Pagamento::select((DB::raw('sum(valor) as valor')))
            ->whereRaw('MONTH(STR_TO_DATE(CONCAT("01,", SUBSTR(mes_referencia, 1, 2), ",", SUBSTR(mes_referencia, 3, 4)), "%d,%m,%Y")) = ?', [$mes])->get();
        return $valor->all();
    }


}
