<?php

namespace App\Models;

use App\Classes\DBConnection;
use PDO;

class Rating
{

    public static function ratePost(int $postId, int $rate)
    {
        $query = "INSERT INTO `post_rating` (`post_id`, `rate_value`)
                VALUES (:postId, :rate);
                 ";

    }

    public static function getRate(int $postId)
    {

        $query = "
        SELECT post_rating.rate_value
        FROM post_rating
        WHERE post_id = :postId";

    }

}