<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContratoRequest extends FormRequest
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
    public function rules()
    {

        return [
            'alerta' => [
                'required', 'string',
            ],
            'valor' => [
                'required', 'numeric',
            ],
            // 'duracao_contrato' => [
            //     'required', 'numeric',
            // ],
            // 'dias_para_vencimento' => [
            //     'required', 'numeric',
            // ],
            'data_assinatura' => [
                'required', 'date',
            ],
            'data_inicio_vigencia' => [
                'required', 'date',
            ],
            'data_vencimento' => [
                'required', 'date',
            ]
        ];
    }
}
