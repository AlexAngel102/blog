<?php

use App\Helpers\CookieSetHelper;
use App\Psr4AutoloaderClass;
use App\Vendor\DBConnection;

include "../lib/dump.php";
require_once "../lib/Psr4AutoloaderClass.php";
require_once "../routs/web.php";

$loader = new Psr4AutoloaderClass;
$loader->addNamespace('App', "../app/");
$loader->addNamespace('App\Vendor', "../lib/");
$loader->register();


CookieSetHelper::set_coockies();
DBConnection::connect();
session_start();