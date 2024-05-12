<?php

namespace App\Hps;

use Illuminate\Support\Facades\DB;

class eTransaction extends Base
{
    public function begin_transaction() {
        DB::beginTransaction();
    }

    public function transaction_commit(): void
    {
        DB::commit();
    }

    public function transaction_roll_back(): void
    {
        DB::rollBack();
    }
}
