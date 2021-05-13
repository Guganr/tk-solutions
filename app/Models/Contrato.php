<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Contrato extends Model
{
    use HasFactory, SoftDeletes;
    private $users;

    protected $fillable = [
        'data_assinatura', 
        'valor', 
        'data_inicio_vigencia', 
        'data_vencimento', 
        'duracao_contrato', 
        'dias_para_vencimento', 
        'acessor_id', 
        'alerta'
    ];
    public $incrementing = true;

    protected $dateFormat = 'U';


    public function getDiasParaVencimento() {
        $hoje=date_create(date("Y-m-d"));
        $vencimento=date_create($this->data_vencimento);
        $diff = date_diff($hoje, $vencimento);
        return $this->diffFormat($diff, 'Contrato encerrado.');
    }

    public function getDuracaoContrato() {
        $vigencia=date_create($this->data_inicio_vigencia);
        $vencimento=date_create($this->data_vencimento);
        $diff = date_diff($vigencia, $vencimento);
        return $this->diffFormat($diff, $diff->format("%a dias"));
    }

    private function diffFormat($diff, $msg) {
        $operador = $diff->format("%R");
        if ($operador == '-') {
            echo $msg;
        } else {
            echo $diff->format("%a dias");
        }
    }


    public function cliente() {
        $user = ClienteVendedor::where('id', $this->cliente_vendedor_id)->first();
        $cliente = User::where('id', $user->cliente_id)->first();
        $cliente->refresh();
        echo "<a target='_blank' href='".route('users.show', $cliente->id) ."' >" . $cliente->name."</a>";
    }

    public function vendedor() {
        $user = ClienteVendedor::where('id', $this->cliente_vendedor_id)->first();
        $vendedor = User::where('id', $user->vendedor_id)->first();
        $vendedor->refresh();
        echo "<a target='_blank' href='" . route('users.show', $vendedor->id) . "' >" . $vendedor->name . "</a>";
    }

    public function acessor() {
        $acessor = User::where('id', $this->acessor_id)->first();
        if (null !== $acessor) {
            $acessor->refresh();
            echo "<a target='_blank' href='" . route('users.show', $acessor->id) . "' >" . $acessor->name . "</a>";
        } else {
            return '-';
        }
    }

    public function rendimentos() {
        return $this->hasMany(Rendimento::class);
    }

    public function alertas() {
        return $this->hasMany(Alerta::class);
    }

    public function pagamentos() {
        return $this->hasMany(Pagamento::class);
    }
    public function acessorAtual($id)
    {

        if ($this->id == $id)
            return "selected";
        else
            return "";
    }
}
