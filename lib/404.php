<?php

if (http_response_code() === 404) {
    require_once "../view/layoutHeader.php";
    require_once "../view/errors/404.html";
    require_once "../view/errors/mainButton.html";
    require_once "../view/layoutFooter.php";
    die();
}