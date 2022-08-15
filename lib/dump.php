<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

function dump($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>".PHP_EOL;
}