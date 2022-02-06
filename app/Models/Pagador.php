<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagador extends Model
{
    use HasFactory;
    protected $fillable = [
    "nome" ,
    "id_usuario",
    "documento" ,
    "celular",
    "email",
    "data_de_nascimento",
    "cep" ,
    "rua" ,
    "bairro" ,
    "cidade",
    "estado",
    "numero",
    "complemento"
    ];
}
