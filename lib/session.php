<?php

function my_session_start() {
    session_start();
    if (!empty($_SESSION['deleted_time']) && $_SESSION['deleted_time'] < time() - 180) {
        session_destroy();
        session_start();
    }
}

function my_session_regenerate_id() {
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    $newid = session_create_id('RATE-');
    $_SESSION['deleted_time'] = time() + 60*60*24;
    session_commit();
    ini_set('session.use_strict_mode', 0);
    session_id($newid);
    session_start();
}

ini_set('session.use_strict_mode', 1);
my_session_start();

my_session_regenerate_id();
