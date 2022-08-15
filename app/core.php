<?php


use App\Helpers\CookieSetHelper;
use App\Lib\Psr4AutoloaderClass;
use App\Lib\DBConnection;
use App\Lib\Router;

require_once "../lib/Psr4AutoloaderClass.php";
include "../lib/dump.php";

$loader = new Psr4AutoloaderClass;
$loader->addNamespace('App', "../app/");
$loader->addNamespace('App\Lib', "../lib/");
$loader->register();


CookieSetHelper::set_coockies();
DBConnection::connect();
session_start();

require_once "../routs/web.php";
