<?php

?>

<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Compiled and minified CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/materialize.min.css" rel="stylesheet">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Blog</title>
</head>
<body>
<div class="container align-center">
    <?php
//    include_once "errors/404.html";
////    die();
    ?>
    <div class="row container p-3">
        <div class="col">
            <a href="#" class="z-depth-3 waves-effect waves-light btn-large">Negative posts {$negativePosts}</a>
        </div>
        <div class="col">
            <a href="#" class="z-depth-3 waves-effect waves-light btn-large">All posts {$allPosts}</a>
        </div>
        <div class="col">
            <a href="#" class="z-depth-3 waves-effect waves-light btn-large">Positive posts {$positivePosts}</a>
        </div>
    </div>
    <?php
    include_once 'post.php';
    ?>
</div>
</body>
</html>
