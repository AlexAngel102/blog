<?php

namespace App\Controllers;

use App\Models\Comment;

class CommentController extends Controller
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
        try {
            $postId = self::check($_POST['post_id']);
            $userName = self::check($_POST['visitor_name']);
            $comment = self::check($_POST['comment']);
            $date = date('Y-m-d');
            if (mb_strlen($comment) > 250) {
                echo "Comment to long";
                exit();
            }

            Comment::addComment($postId, $userName, $comment, $date);
        } catch (\Exception $e) {
            error_log('PDOException - ' . $e->getMessage(), 0);
            http_response_code(403);
        }
    }
}