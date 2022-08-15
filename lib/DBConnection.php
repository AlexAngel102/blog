<?php

namespace App\Vendor;

use PDO;

class DBConnection
{
    public static function connect()
    {
        extract(DotEnvParser::credentials("../.env"));
        define('DB', new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASS));
    }
}