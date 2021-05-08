<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
