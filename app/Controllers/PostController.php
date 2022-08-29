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
                $id = self::check($_GET['post']);
                if (is_numeric($id)) {
                    return Post::getPost($id);;
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
            return Post::getAllPost();
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