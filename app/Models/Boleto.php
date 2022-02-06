<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boleto extends Model
{
    use HasFactory;
    protected $fillable = [
      'id_usuario', 'id_pagador', 'data_vencimento', 'valor_boleto', 'instrucao_1', 'instrucao_2',
      'instrucao_3', 'descricao', 'tipo_multa', 'valor_multa', 'tipo_juros', 'valor_juros', 'tipo_desconto',
      'valor_desconto', 'data_limite_desconto', 'referencia'
    ];
}
