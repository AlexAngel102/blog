<?php

namespace App\Models;

use App\Lib\DBConnection;
use PDO;

class Post
{
    public static function getAllPost(){
        $query = "
            SELECT *
            FROM post
        ";
        $posts = DB->query($query);
        $result = $posts->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
            return "Post not found";
        }
        return $result;
    }
}