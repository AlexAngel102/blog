<?php

use App\Classes\Router;

Router::route("GET",'/', 'PostController::getPost');

Router::route("GET", '/(\?(post=(\d*)))$', 'PostController::getPost');
Router::route("POST",'/addpost', "PostController::addPost");
