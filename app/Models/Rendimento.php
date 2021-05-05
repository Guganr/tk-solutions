<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rendimento extends Model
{
    use HasFactory;
    protected  $primaryKey = 'id';
    protected $fillable = [
        'contrato_id',
        'valor',
        'mes_referencia'
    ];
    public function rendimentos() {
        return $this->hasOne(Contrato::class);
    }

    public function verificaDatasValidas($contrato , $dt ) {
        dd($contrato);
        for($i = 0; $i < sizeof($contrato[0]); $i++) {
            if ($dt== $contrato[$i]) {
                return false;
            }
        }
        return true;
    }
}
