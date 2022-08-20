<?php

namespace App\Classes;

use PDO;
use PDOException;

class DBConnection
{
    public static function connect()
    {
        try {
            extract(DotEnvParser::credentials("../.env"));
            define('DB', new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASS));
        }catch (PDOException){
            header("", true,500);
        }
    }
}