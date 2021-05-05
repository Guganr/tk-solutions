<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    use HasFactory;
    protected  $primaryKey = 'id';
    protected $fillable = [
        'contrato_id',
        'mensagem'
    ];
    public function alertas()
    {
        return $this->hasOne(Contrato::class);
    }
}
