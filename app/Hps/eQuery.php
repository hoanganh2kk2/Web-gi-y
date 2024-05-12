<?php

namespace App\Hps;

use Illuminate\Support\Facades\DB;

class eQuery extends Base
{
    public function check_query()
    {
        DB::enableQueryLog();
    }

    public function get_query(): array
    {
        return DB::getQueryLog();
    }
}
