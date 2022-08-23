<?php

namespace App\Models;

use App\Classes\DBConnection;
use PDO;

class Comment extends AbstractModel
{
    public static function getComments(int $id)
    {
        $query =
            "
            SELECT
                comment.comment,
                comment.created_at,
                comment.visitore_name
            FROM comment
            WHERE comment.post_id = :id
            ORDER BY comment_id desc 
        ";
        $statement = DB->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
            return;
        }
        return $result;
    }

    public static function addComment(int $postID, string $userName, string $text, string $date)
    {
        $query = "
            INSERT INTO `comment` (`comment`, `post_id`, `visitore_name`, `created_at`)
            VALUES (:text, :postId, :name, :date)
        ";
        $statement = DB->prepare($query);
        $statement->bindParam(':postId', $postID);
        $statement->bindParam(':text', $text);
        $statement->bindParam(':name', $userName);
        $statement->bindParam(':date', $date);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
            return;
        }
        return $result;
    }
}