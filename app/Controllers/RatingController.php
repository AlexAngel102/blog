<?php

namespace App\Controllers;

use App\Models\Rating;

class RatingController extends Controller
{
    public static function ratePost()
    {
        if (self::check($_POST['post_id']) && is_numeric($_POST['post_id'])) {
            $postId = $_POST['post_id'];
        } else {
            http_response_code(403);
        }

        if (self::check($_POST['post_id']) && is_numeric($_POST['post_id'])) {
            $value = $_POST['rating'];
            if ($value >= 1 && $value <=5) {
                $rating = $value;
            }
        } else {
            http_response_code(403);
        }

        $result = Rating::ratePost($postId, $rating);
        echo json_encode($result);
    }

    public static function getRating()
    {
        if (self::check($_POST['post_id']) && is_numeric($_POST['post_id'])) {
            $postId = $_POST['post_id'];
        } else {
            http_response_code(403);
        }

        $result = Rating::getRate($postId);

        json_encode($result);
    }

}