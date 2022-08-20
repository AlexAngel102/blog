<?php

namespace App\Models;

use PDO;

class User
{
    public function getUser(int $userID)
    {
        $query = sprintf("
            SELECT *
            FROM user 
            WHERE user_id = %s        ", $userID);
        $user = DB->query($query);
        $info = $user->fetchAll(PDO::FETCH_ASSOC);
        if (empty($info)) {
            return "User not found";
        }
        return $info;
    }

}