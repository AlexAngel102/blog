<?php

use App\Classes\CookieHelper;
use App\Classes\Psr4AutoloaderClass;
use App\Classes\DBConnection;
use App\Classes\Router;

require_once "../lib/Classes/Psr4AutoloaderClass.php";
require_once "../lib/error_handler.php";
include "../lib/dump.php";

$loader = new Psr4AutoloaderClass;
$loader->addNamespace('App', __DIR__."/../app/");
$loader->addNamespace('App\Classes', __DIR__."/../lib/Classes/");
$loader->register();

CookieHelper::setCookies();
DBConnection::connect();

require_once "../routs/web.php";
Router::run();

require_once "../lib/404.php";