<?php

namespace App\Hps;

use Illuminate\Support\Facades\DB;

class eJson extends Base
{
    public function showJson($json)
    {
        if (config('app.debug')) {
            $json['debug']['sql'] = DB::getQueryLog();
            $json['debug']['post'] = $_POST;
            $json['debug']['get'] = $_GET;
            $json['debug']['cookie'] = $_COOKIE;
            $json['debug']['raw'] = file_get_contents('php://input');
        }
        app('debugbar')->disable();
        header('Content-Type: application/json');
        die(json_encode($json));
    }

    public function getJsonSuccess($msg = null , $value = []){
        $success  = [
            'msg' => $msg ?? 'Thành công',
            'status' => 200,
            'result' => $value
        ];
        $this->showJson($success);
    }

    public function getJsonError($msg = null, $key = null){
        $error  = [
            'msg' => $msg ?? 'Thất bại',
            'status' => 422,
            'key' => $key ?? 'error'
        ];
        $this->showJson($error);
    }

}
