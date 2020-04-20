<?php


namespace App\Helpers;


class RequestHelper
{
    private static $hosts = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_X_CLUSTER_CLIENT_IP',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'REMOTE_ADDR'
    ];


    /**
     * @return mixed|string
     */
    public static function getIp(){
        foreach (self::$hosts as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP) !== false){
                        return $ip;
                    }
                }
            }
        }
        if(!isset($ip)){
            return request()->ip();
        }
    }
}
