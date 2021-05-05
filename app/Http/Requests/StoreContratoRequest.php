<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\ClienteVendedor;
use Illuminate\Support\Facades\Gate;

class StoreContratoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function cvId()
    {
        $cv = ClienteVendedor::where('cliente_id', $this->input('clientes', []))->first();
        return $cv->id;
    }

    public function rules()
    {
        return [
            'alerta' => [
                'required', 'string',
            ],
            'valor' => [
                'required', 'numeric',
            ],
            'data_assinatura' => [
                'required', 'date',
            ],
            'data_inicio_vigencia' => [
                'required', 'date',
            ],
            'data_vencimento' => [
                'required', 'date',
            ],
            'clientes.*'  => [
                'integer',
            ],
            'clientes'    => [
                'required',
                'array',
            ],
        ];
    }
}
