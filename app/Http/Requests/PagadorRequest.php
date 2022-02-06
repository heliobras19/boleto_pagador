<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class PagadorRequest extends FormRequest
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
            'nome' => 'required|string',
            'documento' => 'required',
            'celular' => 'required|max:10',
            'email' => 'required|email',
            'data_de_nascimento' =>'required|date',
            'cep' => 'required|max:11',
            'rua' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required',

        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
