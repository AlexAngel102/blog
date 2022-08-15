<?php

namespace App\Models;

use PDO;

class User
{
    private $userName;
    private $cookies;
    private $id;

    public function __construct(string $userName)
    {
        $this->cookies = $_COOKIE;
        $this->userName = $userName;
    }

    public function setCookies(): void
    {
        $this->cookies = $_COOKIE['token'];
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    public function getCookies()
    {
        return $this->cookies;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

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