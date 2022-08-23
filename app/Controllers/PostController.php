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
                if (isset($id) && is_numeric($id)) {
                    $posts = Post::getPost($id);
                    require_once __DIR__ . '/../../view/layoutHeader.php';
                    require_once __DIR__ . '/../../view/postsBar.php';
                    require_once __DIR__ . '/../../view/post.view.php';
                    require_once __DIR__ . '/../../view/reply.php';
                    require_once __DIR__."/../../view/addComment.php";
                    require_once __DIR__ . '/../../view/layoutFooter.php';
                    return;
                }
            }
            $posts = Post::getAllPost();
            require_once __DIR__ . '/../../view/layoutHeader.php';
            require_once __DIR__ . '/../../view/postsBar.php';
            require_once __DIR__ . '/../../view/post.view.php';
            require_once __DIR__ . '/../../view/addPost.php';
            require_once __DIR__ . '/../../view/layoutFooter.php';
        } catch (\PDOException $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
            http_response_code(403);
        }
    }

    public static function addPost()
    {
        $userName = $_POST['visitor_name'];
        $text = $_POST['post'];
        $date = date('Y-m-d');
        Post::addPost($userName, $text, $date);
    }
}