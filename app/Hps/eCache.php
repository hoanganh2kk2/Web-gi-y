<?php

namespace App\Hps;

use Illuminate\Support\Facades\Cache;

class eCache extends Cache
{
    static private $instance = [];

    public function __construct()
    {
        self::$instance = &$this;
    }

    public static function &getInstance()
    {
        if (!self::$instance) {
            new self();
        }
        return self::$instance;
    }

    static function add($key, $value, $ttl = 846000): bool
    {
        return parent::add($key, $value, $ttl);
    }

    static function get($key, $default = null)
    {
        return parent::get($key, $default);
    }

    static function del($key): bool
    {
        return parent::forget($key);
    }
}
