<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoletoController extends Controller
{
    public function __construct()
    {
    }

    public function create(Request $request){
        $request->validate([
            'id_pagador' => 'required',
            'id_usuario' => 'required',
            'data_vencimento' => 'required',
            'valor' => 'required',
        ]);
    }
}
