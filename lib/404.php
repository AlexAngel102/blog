<?php

if (http_response_code() === 404) {
    require_once __DIR__."/../view/layoutHeader.php";
    require_once __DIR__."/../view/errors/404.html";
    require_once __DIR__."/../view/errors/mainButton.html";
    require_once __DIR__."/../view/layoutFooter.php";
    die();
}