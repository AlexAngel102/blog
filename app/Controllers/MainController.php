<?php

namespace App\Controllers;

class MainController
{
    public static function view()
    {
        require_once __DIR__ . '/../../view/layoutHeader.php';
        require_once __DIR__ . '/../../view/postsBar.php';
        require_once __DIR__ . '/../../view/posts.view.php';
        require_once __DIR__ . '/../../view/layoutFooter.php';
    }
}