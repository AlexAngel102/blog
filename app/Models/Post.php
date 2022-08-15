<?php

namespace App\Models;

use App\Vendor\DBConnection;
use PDO;

class Post
{
    private $use;
    private $post;
    private $id;
    private $date;

    public function __construct($userName)
    {
//        $this->id =
        $this->userName = $userName;
//        $this->coockies = ;
    }

    public function setUserName($userName): void
    {
        $this->userName = $userName;
    }

    public function setCoockies($cookies): void
    {
        $this->coockies = $cookies;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getCoockies()
    {
        return $this->coockies;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAllPost(){
        DBConnection::connect();
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