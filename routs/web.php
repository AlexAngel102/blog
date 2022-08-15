<?php

use App\Lib\Router;

Router::route("GET",'/', function () {
    $result = require_once "../view/post.php";
    return $result;
});

Router::route("POST",'/form', 'MainController::getPosts');

Router::route('POST','/test', 'MainController::hello');