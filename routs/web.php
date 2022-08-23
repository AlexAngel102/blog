<?php

use App\Classes\Router;

/**
 * Multiple params for $_GET request
 * /\/?((&|\?)[a-zA-Z]+=(\w+))+
 * /(\?(post=(\d+)))$
 **/


Router::route("GET",'/$', 'PostController::getPost');

Router::route("GET", '/posts/(\?(post=(\d+)))$', 'PostController::getPost');

Router::route("POST",'/addpost', "PostController::addPost");

Router::route("GET", '/getComments/(\?(post=(\d+)))$', "CommentController::getComments");

Router::route("POST",'/addcomment', "CommentController::addComment");
