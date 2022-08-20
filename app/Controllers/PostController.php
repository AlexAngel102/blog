<?php

namespace App\Controllers;

use App\Classes\CookieHelper;
use App\Models\Post;

class PostController
{
    public static function getPost()
    {
        try {
        if (key_exists('post', $_GET)) {
            $id = $_GET['post'];
            if (isset($id)) {
                $posts = Post::getPost($id);
                require_once __DIR__ . '/../../view/layoutHeader.php';
                require_once __DIR__ . '/../../view/postsBar.php';
                require_once __DIR__ . '/../../view/post.php';
                require_once __DIR__ . '/../../view/layoutFooter.php';
                return;
            }
        }}catch (\ErrorException $e){
            http_response_code(403);
        }
        $posts = Post::getAllPost();
        require_once __DIR__ . '/../../view/layoutHeader.php';
        require_once __DIR__ . '/../../view/postsBar.php';
        require_once __DIR__ . '/../../view/post.php';
        require_once __DIR__ . '/../../view/layoutFooter.php';
    }

    public static function addPost()
    {
        $cookies = CookieHelper::parseCookies();
        $text =
        Post::addPost($userName, $text);
    }
}