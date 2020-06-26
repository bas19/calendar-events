<?php

namespace App\Helper;

class Helper {

    /**
     * Api response helper format
     * 
     * @param $success  boolean
     * @param $data     array
     * @param $code     int 
     * 
     * @return \Illuminate\Http\Response
     */
    public static function apiResponse($success, $data, $code) {
        return response([
            'success' => $success,
            'data' => $data
        ], $code);
    }
}