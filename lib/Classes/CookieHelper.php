<?php

namespace App\Classes;

class CookieHelper
{
    public static function setCookies()
    {
        if (!isset($_COOKIE['token'])) {
            $bytes = random_bytes(20);
            $bytes = bin2hex($bytes);
            setcookie('token', $bytes, time() + (60 * 60 * 24 * 365)*3);
        }
    }

    public static function parseCookies()
    {
        $cookies = $_SERVER['HTTP_COOKIE'];
        $cookies = explode(';', $cookies);
        $cookies = array_map(fn($a)=>trim($a), $cookies);
        foreach ($cookies as $cookie){
            $arr = explode("=",$cookie);
            $result[$arr[0]] = $arr[1];
        }
        return $result;
    }
}