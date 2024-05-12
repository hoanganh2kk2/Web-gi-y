<?php

namespace App\Hps;

class eHelper extends Base
{
    public function formatMoney($stringNumber, $sep = '.', $format = ' ₫')
    {
        if(!$stringNumber) {
            return 0;
        }
        $stringNumber = (double)$stringNumber;
        if(!$stringNumber){
            return $stringNumber;
        }
        return number_format($stringNumber, 0, ',', $sep).$format;
    }

    public function formatNumber($stringNumber)
    {
        if(!$stringNumber) {
            return 0;
        }
        $stringNumber = (double)$stringNumber;
        if(!$stringNumber){
            return $stringNumber;
        }
        return number_format($stringNumber);
    }

    public function buildTokenString(int $id): string
    {
        return $id . '-' . sha1($id . 'cinv' . $id . 'linh');
    }

    public function validateToken($token, $id = ''): bool
    {
        $obj = explode('-', $token);
        if (!isset($obj[1])) {
            return false;
        }
        if (!$id) {
            $id = $obj[0];
        }
        if (self::buildTokenString($id) == $token) {
            return true;
        }
        return false;
    }
}
