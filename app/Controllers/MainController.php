<?php

namespace App\Controllers;

use App\Models\Post;

class MainController
{
    public function getPosts(){
        dump(Post::getAllPost());
    }

    public function hello(array $post){
        var_dump($post);
    }
}
