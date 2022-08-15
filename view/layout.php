<?php

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
<?php
if (http_response_code() === 404) {
    include_once "errors/404.html";
    echo "<div class='container'>
            <a href='/' class='btn white-text z-depth-3 '><span class='text-center px-3'>
            <i class='tiny material-icons'>arrow_back</i>
            Back to main</span>
            </a>
            </div>";
    die();
}
?>
<div class="container align-center">

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
    dump($_GET);
    if(isset($_GET)) {
        require_once "../view/";
    }
    ?>
</div>
</body>
</html>
