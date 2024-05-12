<?php

namespace App\Hps;

use Illuminate\Support\Facades\DB;

class eLogs extends Base
{
    protected $request;

    function getLogTableName(): string
    {
        return '_log';
    }

    public function create($objectId, $type, $table, $objToSave, $before = [], $after = [], $guard = false) :bool
    {
        try {
            $created_by = json_encode([
                'id' => @Auth()->user()->id,
                'account' => @Auth()->user()->account,
                'email' => @Auth()->user()->email,
                'name' => @Auth()->user()->name,
            ]);
            if($guard) {
                $guard = 'client';
            }else{
                $guard = 'admin';
            }
            DB::table($this->getLogTableName())->insertGetId([
                'object_id' => $objectId,
                'project' => 1,
                'guard' => $guard,
                'type' => $type,
                'table' => $table,
                'obj_to_save' => !empty($objToSave) ? json_encode($objToSave) : null,
                'before' => !empty($before) ? json_encode($before): null,
                'after' => !empty($after) ? json_encode($after): null,
                'created_by' => $created_by,
                'client_info' => json_encode([
                    'agent' => @$_SERVER['HTTP_USER_AGENT'],
                    'referer' => @$_SERVER['HTTP_REFERER'],
                    'ip' => $_SERVER['REMOTE_ADDR'],
                ]),
                'created_at' => time(),
            ]);
            return true;
        }catch (\Exception $e) {

        }
    }

}
