<?php

namespace App\Helpers; 

class ResponseJSON {
    
    public static function successWithData(string $msg_status, array $data) {
        return response()->json([
            'code_status' => 200,
            'msg_status' => $msg_status,
            'data' => $data
        ], 200);
    }

    public static function unauthorized(string $msg_status) {
        return response()->json([
            'message' => $msg_status
        ], 401);
    }
}