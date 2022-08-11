<?php

use App\Psr4AutoloaderClass;
use App\Controllers\Controller;

require_once "../vendor/Psr4AutoloaderClass.php";
require_once "../vendor/db_connect.php";

$loader = new Psr4AutoloaderClass;
$loader->register();
$loader->addNamespace('App', "../app/");

//include "../view/layout.php";