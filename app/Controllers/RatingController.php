<?php

namespace App\Controllers;

use App\Models\Rating;

class RatingController extends Controller
{
    public static function ratePost()
    {
        if (self::check($_POST['post']) && is_numeric($_POST['post'])) {
            $postId = $_POST['post'];
        } else {
            http_response_code(403);
        }

        if (self::check($_POST['rating']) && is_numeric($_POST['rating'])) {
            $value = $_POST['rating'];
            if ($value >= 1 && $value <=5) {
                $rating = $value;
            }
        } else {
            http_response_code(403);
        }

        Rating::ratePost($postId, $rating);
    }

    public static function getRating()
    {
        if (self::check($_GET['post']) && is_numeric($_GET['post'])) {
            $postId = $_GET['post'];
        } else {
            http_response_code(403);
        }

        return Rating::getRate($postId);

    }

}