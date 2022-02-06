<?php

namespace App\Http\Controllers;


use App\Http\Requests\PagadorRequest;
use App\Repository\PagadorRepository;
use App\Services\ResponseAPI;
use Illuminate\Http\Request;

class PagadorController extends Controller
{
    private $repository, $response;
    public function __construct(PagadorRepository $repository, ResponseAPI $response)
    {
        $this->middleware('auth:api');
        $this->response = $response;
        $this->repository = $repository;
    }

    public function create(Request $request, PagadorRequest $pagadorRequest){
        $pagador = $request->all();
        $pagador['id_usuario'] = auth()->id();
        $data = $this->repository->create($pagador);
        if ($data['result'] == 'success')
            return $this->response->sucess($data['data']);
        else
            return $this->response->error("erro ao cadastrar", $data['data']);
    }

    public function destroy(int $id)
    {
        $pagador = $this->repository->destroy($id);
        if ($pagador['result'] == 'success')
            return $this->response->sucess("Pagador deletado");
        else
            return $this->response->error("error", "Houve uma exceção, o usuario possui boletos");
    }

    public function update(int $pagador_id, Request $request, PagadorRequest $pagadorRequest){
        $data_pagador = $request->all();
        $update = $this->repository->update($pagador_id, $data_pagador);
        if ($update['result'] == 'success')
            return $this->response->sucess($data_pagador);
        else
            return $this->response->error('error', 'houve uma exceção');
    }

    public function show()
    {
        $data = $this->repository->show(auth()->id());
        return $this->response->sucess($data);
    }
}
