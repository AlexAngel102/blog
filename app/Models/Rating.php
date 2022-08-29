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
        $statement = DB->prepare($query);
        $statement->bindParam(':postId', $postId);
        $statement->bindParam(':rate', $rate);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
            return;
        }
        return $result;

    }

    public static function getRate(int $postId)
    {

        $query = "
        SELECT post_rating.rate_value
        FROM post_rating
        WHERE post_id = :postId";
        $statement = DB->prepare($query);
        $statement->bindParam(':postId', $postId);
        $statement->execute();
        $rates = $statement->fetchAll();
        if (empty($rates)) {
            return $result[0] = 0;
        }
        foreach ($rates as $value){
            $result[] = $value['rate_value'];
        }
        return $result;

    }

}