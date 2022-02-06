<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class BoletoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_pagador' => 'required|int',
            'data_vencimento' => 'required|date',
            'valor_boleto' => 'required|int',
            'descricao' => 'required|string',

        ];
    }

    public function relative_required(array $data){
        $error = [];
        if (isset($data["tipo_multa"])){
            if (!isset($data['valor_multa'])){
              $error[] = "valor_multa is required if isset tipo_multa";
            }
        }

        if (isset($data["tipo_juros"])){
            if (!isset($data['valor_juros'])){
               $error[] = "valor_juros is required if isset tipo_juros";
            }
        }

        if (isset($data["tipo_desconto"])){
            if (!isset($data['valor_desconto'])){
                $error[] = "valor_desconto is required if isset tipo_desconto";
            }
            if (!isset($data['data_limite_desconto'])){
                $error[] = "data_limite_desconto is required if isset tipo_desconto";
            }
        }
        return $error;
    }

    public function failedValidation(Validator $validator){
        throw new \Illuminate\Http\Exceptions\HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));

    }
}
