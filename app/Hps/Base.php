<?php

namespace App\Hps;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;


abstract class Base
{
    public static $instances = [];
    public static $storage = [];

    public static function &getInstance()
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }
        return self::$instances[$cls];
    }

    public static function set($k, $v){
        self::$storage[$k] = $v;
    }

    public function get($k, $def = null){
        return self::$storage[$k] ?? $def;
    }

    static function groupBy($key, $data): array
    {
        $result = array();

        foreach ($data as $val) {
            if (array_key_exists($key, $val)) {
                $result[$val[$key]][] = $val;
            } else {
                $result[""][] = $val;
            }
        }

        return $result;
    }

    static function keyBy($key, $data): array
    {
        $result = array();

        foreach ($data as $val) {
            if (array_key_exists($key, $val)) {
                $result[$val[$key]] = $val;
            } else {
                $result[""] = $val;
            }
        }

        return $result;
    }

    /**
     * The attributes that are mass assignable.
     * @param $items
     * @param int $perPage
     * @param null $page
     * @param array $options
     * @return LengthAwarePaginator
     */

    public function paginate($items, int $perPage = 5, $page = null, array $options = []): LengthAwarePaginator
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

}
