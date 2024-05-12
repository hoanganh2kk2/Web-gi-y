<?php

namespace App\Hps;

class eDate extends Base
{

    protected static $days = array('Mon' => 'Thứ 2', 'Tue' => 'Thứ 3', 'Wed' => 'Thứ 4', 'Thu' => 'Thứ 5', 'Fri' => 'Thứ 6', 'Sat' => 'Thứ 7', 'Sun' => 'Chủ nhật');
    public function dateFormat($time = 0, $format = 'd/m - H:i', $vietnam = false, $show_time = false)
    {
        if(!is_int($time)){
            $time = date_create($time);
            if ($time) {
                $time = $time->getTimestamp();
            }else {
                return false;
            }
        }

        $return = date($format,$time);
        if ($vietnam){
            $return = ($show_time ? date('H:i - ',$time) : '') . self::$days[date('D',$time)] . ', ngày ' . date('d/m/Y',$time);
        }
        return $return;
    }

    public function getTimestampFromVNDate($str_date = '', $end = false, $start = false)
    {
        $time_str = str_replace('/', '-', $str_date);
        if($end){
            $time_str .= " 23:59:59";
        }else if($start){
            $time_str .= " 00:00:00";
        }
        return strtotime($time_str);
    }

    static function validateDateTime($date, $format = 'd/m/Y H:i'): bool
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}
