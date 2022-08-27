<?php

namespace App\Models;

use App\Classes\DBConnection;
use PDO;

class Post
{
    public static function getAllPost()
    {
        $query = "
            SELECT
                post.post_id,
                post.post,
                post.created_at,
                post.visitore_name
            FROM
                post
            ORDER BY 
                post_id DESC;
        ";
        $statement = DB->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
            return "Posts not found";
        }
        return $result;
    }

    public static function getPost(int $id)
    {
        $query =
            "
            SELECT
                post.post_id,
                post.post,
                post.created_at,
                post.visitore_name
            FROM
                post
            WHERE post_id = :id;
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

    public static function addPost(string $userName, string $text, string $date)
    {
        $query = "
        INSERT INTO `post` (`post`, `visitore_name`, `created_at`) 
        VALUES (:text, :name, :date);
        ";
        $statement = DB->prepare($query);
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