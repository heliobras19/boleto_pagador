<?php

namespace App\Services;

class ResponseAPI
{
    public function sucess($data){
        return response()->json([
            'success'   => true,
            'message'   => 'request successes',
            'data'      => $data
        ]);
    }

    public function error($msg, $data){
        return response()->json([
            'success'   => false,
            'message'   => $msg,
            'data'      => $data
        ]);
    }
}
