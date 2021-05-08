<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected  $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'responsavel',
        'status',
        'mensagem'
    ];
    public function replicas()
    {
        return $this->hasMany(Replica::class);
    }

    public function getStatus($status) {
        switch ($status) {
            case 1:
                return "Aberto";
                break;
            case 2:
                return "Em andamento";
                break;
            case 3:
                return "Encerrado";
                break;
            
            default:
                return "Erro.";
                break;
        }
    }

    public function statusAtual($status) {
        
        if ($this->status == $status)
            return "selected";
        else 
            return "";
    }
}
