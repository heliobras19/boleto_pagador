<?php

namespace App\Repository;

use App\Models\Pagador;

class PagadorRepository implements Repository
{
    private $pagador;
    public function __construct(Pagador $pagador)
    {
        $this->pagador = $pagador;
    }

    public function create(array $data)
    {
        try {
            $created = $this->pagador::create($data);
            return [
                'result' => 'success',
                'data' =>$created
            ];
        }catch (\Exception $exception){
            return ['result' => 'fail','data' => $exception];
        }
    }

    public function destroy(int $id)
    {
        try {
            $pagador = $this->pagador->findOrFail($id);
            $pagador->delete();
            return [
                'result' => 'success'
            ];
        }catch (\Exception $exception){
            return [
                'result' => 'fail',
                'data' => $exception
            ];
        }

    }

    public function update(int $id, array $data)
    {
        try {
            $pagador = $this->pagador->findOrFail($id);
            $pagador->update($data);
            return [
                'result' => 'success',
                'data' => $pagador
            ];
        }catch (\Exception $exception){
            return [
                'result' => 'fail',
                'data' => $exception
            ];
        }
    }

    public function show($id)
    {
        return $this->pagador::where('id_usuario', $id)->get();
    }
}
