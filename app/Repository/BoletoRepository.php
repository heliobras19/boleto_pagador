<?php

namespace App\Repository;

use App\Models\Boleto;
class BoletoRepository implements Repository
{
    private $boleto;
    public function __construct(Boleto $boleto)
    {
        $this->boleto = $boleto;
    }

    public function create(array $data)
    {
        try {
            $created = $this->boleto::create($data);
            if ($created)
                return ["suceess",$created];
            else
                return false;
        } catch (\Exception $e){
            return [$e];
        }

    }

    public function show($id){
        return $this->boleto::where('id_usuario', $id)->get();
    }

    public function show_by_pagador($id){
        return $this->boleto::where([
            'id_pagador' => $id,
            'id_usuario' => auth()->id()
        ])->get();
    }

    public function destroy(int $id)
    {
        try {
            $result = $this->boleto->findOrFail($id);
            $result->delete();
            if ($result)
                return ["suceess",$result];
            else
                return false;
        } catch (\Exception $e){
            return [$e];
        }
    }

    public function update(int $id, array $data)
    {
        try {
            $result = $this->boleto->findOrFail($id);
            $result->update($data);
            if ($result)
                return ["suceess",$result];
            else
                return false;
        } catch (\Exception $e){
            return [$e];
        }
    }
}
