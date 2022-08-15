<?php

namespace App\Helpers;

class CookieSetHelper
{
    public static function set_coockies()
    {
        if (!isset($_COOKIE['token'])) {
            $bytes = random_bytes(20);
            $bytes = bin2hex($bytes);
            setcookie('token', $bytes, time() + (60 * 60 * 24 * 365));
        }
    }
}