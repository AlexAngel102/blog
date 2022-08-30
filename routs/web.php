<?php

use App\Classes\Router;

/**
 * Multiple params for $_GET request
 * /\/?((&|\?)[a-zA-Z]+=(\w+))+
 * /(\?(post=(\d+)))$
 **/


Router::route("GET", '/$', 'MainController::view');

Router::route("GET", '/allposts', "PostController::getPosts", true);

Router::route("GET", '/posts/(\?(post=(\d+)))$', 'PostController::getPost', true);

Router::route("POST", '/addpost', "PostController::addPost");

Router::route("GET", '/getComments/(\?(post=(\d+)))$', "CommentController::getComments", true);

Router::route("POST", '/addcomment', "CommentController::addComment");

Router::route("POST", '/ratepost', "RatingController::ratePost");

Router::route("GET", '/getrate/(\?(post=(\d+)))$', "RatingController::getRating", true);

