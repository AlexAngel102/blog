<?php

namespace App\Controllers;

use App\Classes\CookieHelper;
use App\Models\Post;
use App\Models\Rating;

class PostController extends Controller
{
    public static function getPost()
    {
        try {
            if (key_exists('post', $_GET)) {
                $id = $_GET['post'];
                if (isset($id) && is_numeric($id)) {
                    $posts = Post::getPost($id);
                    require_once __DIR__ . '/../../view/post.view.php';
                    require_once __DIR__ . "/../../view/addComment.php";
                    return;
                }
            }

        } catch (\PDOException $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
            http_response_code(403);
        }
    }

    public static function getPosts()
    {
        try {
            $posts = Post::getAllPost();
            require_once __DIR__ . '/../../view/post.view.php';
            require_once __DIR__ . '/../../view/addPost.php';
        } catch (\PDOException $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
            http_response_code(403);
        }
    }


    public static function addPost()
    {
        try {
            $userName = self::check($_POST['visitor_name']);
            $post = self::check($_POST['post']);
            if (mb_strlen($post) > 1024) {
                echo "To long text";
            }
            $date = date('Y-m-d');

            Post::addPost($userName, $post, $date);
        } catch (\Exception $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
            http_response_code(403);
        }
    }
}