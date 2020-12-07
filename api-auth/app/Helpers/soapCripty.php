<?php

namespace App\Helpers;

class soapCripty
{
   
    public static function catAcess()
    {
        return (object) [
            'ip' => self::mountIp (env('WS_TOVS_HOST'), env('WS_TOVS_PORT') ) ,
            'user' => env('WS_TOVS_USER'),
            'password' => env('WS_TOVS_PASS'),
        ];
    }
    private  static function mountIp($host, $port)
    {
        return 'http://' . $host . ':' . $port;
    }
}
