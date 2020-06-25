<?php

namespace App\Helper;

class Helper {

    public static function apiResponse($success, $data, $code) {
        return response([
            'success' => $success,
            'data' => $data
        ], $code);
    }
}