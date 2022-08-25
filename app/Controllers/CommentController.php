<?php

namespace App\Controllers;

use App\Models\Comment;

class CommentController
{
    public static function getComments()
    {
        try {
            if (key_exists('post', $_GET)) {
                $id = $_GET['post'];
                if (isset($id) && is_numeric($id)) {
                    $comments = Comment::getComments($id);
                    require_once __DIR__ . "/../../view/comment.view.php";
                    return;
                }
                return "Not found";
            }
        } catch (\Exception $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
            http_response_code(403);
        }
    }

    public static function addComment()
    {
        $postId = $_POST['post_id'];
        $userName = $_POST['visitor_name'];
        $text = $_POST['post'];
        $date = date('Y-m-d');
        Comment::addComment($postId, $userName, $text, $date);
    }

}