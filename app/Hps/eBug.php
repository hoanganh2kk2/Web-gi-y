<?php

namespace App\Hps;

class eBug extends Base
{

    public function debug($msg): bool
    {
        $msg .= "\nURL: " . "<a href='".@$_SERVER['HTTP_HOST'].@$_SERVER['REQUEST_URI']."'>".@$_SERVER['HTTP_HOST'].@$_SERVER['REQUEST_URI']. "</a>";
        $msg .= "\nREMOTE_ADDR: " . @$_SERVER['REMOTE_ADDR'];
        $msg .= "\nHTTP_USER_AGENT: " . @$_SERVER['HTTP_USER_AGENT'];
        $msg .= "\nHTTP_REFERER: " . @$_SERVER['HTTP_REFERER'];
        $msg .= "\nREQUEST_METHOD: " . @$_SERVER['REQUEST_METHOD'];
        $msg .= "\nSERVER_NAME: " . @$_SERVER['SERVER_NAME'];
        $msg .= "\nHTTP_HOST: " . @$_SERVER['HTTP_HOST'];
        self::pushNotification($msg);
        return true;
    }

    static function pushNotification($msg = ''): bool
    {
        $url = 'https://api.telegram.org/bot5991859183:AAHhz8fFBzAdjImPv5eJzwV-0HzVt0AvFyw/sendMessage?chat_id=1255531608&text=' . urlencode($msg).'&parse_mode=html';
        $ch = curl_init();
        // Set the URL
        curl_setopt($ch, CURLOPT_URL, $url);
        // Removes the headers from the output
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // Return the output instead of displaying it directly
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // Execute the curl session
        curl_exec($ch);
        // Close the curl session
        curl_close($ch);
        // Return the output as a variable
        return true;
    }

}
