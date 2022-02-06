<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoletoRequest;
use App\Models\Boleto;
use App\Repository\BoletoRepository;
use App\Services\ResponseAPI;
use Illuminate\Http\Request;

class BoletoController extends Controller
{
    private $reponse, $repository;
    public function __construct(ResponseAPI $reponse, BoletoRepository $repository)
    {
        $this->reponse = $reponse;
        $this->repository = $repository;
        $this->middleware('auth:api');
    }

    public function create(Request $request, BoletoRequest $boletoRequest){
        $validate_relative = $boletoRequest->relative_required($request->all());
        if ($validate_relative != []){
            return $this->reponse->error("Validation error", $validate_relative);
        }
        $data_cad = $request->all();
        $data_cad['id_usuario'] = auth()->user()->id;
        $data = $this->repository->create($data_cad);
        if ($data[0] == "suceess")
            return $this->reponse->sucess($data[1]);
        else
            return $this->reponse->error("erro ao cadastrar", "Foi encontrado uma excessão, verificar o ID do pagador");
    }

    public function destroy(int $id){
        $boleto = $this->repository->destroy($id);
        if ($boleto[0] == "suceess")
            return $this->reponse->sucess("deletado com sucesso");
        else
            return $this->reponse->error("error", "ID invalido");
    }

    public function update(int $id, Request $request, BoletoRequest $boletoRequest){
        $validate_relative = $boletoRequest->relative_required($request->all());
        if ($validate_relative != [])
            return $this->reponse->error("Validation error", $validate_relative);
        $data_cad = $request->all();
        $data_cad['id_usuario'] = auth()->user()->id;
        $data = $this->repository->update($id, $data_cad);
        if ($data[0] == "suceess")
            return $this->reponse->sucess($data[1]);
        else
            return $this->reponse->error("erro ao editar", "verifica o json");

    }

    public function show(){
        $data = $this->repository->show(auth()->user()->id);
        return $this->reponse->sucess($data);
    }

    public function pagador_boleto(int $id){
        $data = $this->repository->show_by_pagador($id);
        return $this->reponse->sucess($data);
    }

}
