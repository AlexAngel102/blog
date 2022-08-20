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
              post.post_content,
              post.post_date,
              user.user_name,
              (AVG(post_rating.rate_value)) AS rate_value
            FROM post
              LEFT JOIN user
                ON post.user_id = user.user_id
              RIGHT JOIN post_rating
                ON post_rating.post_id = post.post_id
                GROUP BY post_rating.post_id;
        ";
        $posts = DB->query($query);
        $result = $posts->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
            return "Posts not found";
        }
        return $result;
    }

    public static function getPost(int $id)
    {
        $query = /** @lang text */
            "
            SELECT
              post.post_id,
              post.post_content,
              post.post_date,
              user.user_name,
              AVG(post_rating.rate_value) AS rate_value
            FROM post
              INNER JOIN user
                ON user.user_id = post.user_id
              INNER JOIN post_rating
                ON post_rating.post_id = post.post_id
            WHERE post.post_id = $id
            GROUP BY post_rating.post_id,
                     post.post_id
        ";
        DB->prepare($query);
        $posts = DB->query($query);
        $result = $posts->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
            return;
        }
        return $result;
    }

    public static function addPost(){
        dump($_POST);
    }
}