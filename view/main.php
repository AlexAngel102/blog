<?php
$posts = \App\Models\Post::getAllPost();
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

<div class="container align-center">

    <div class="row container p-3">
        <div class="col">
            <a href="#" class="z-depth-3 waves-effect waves-light btn-large white-text">Negative posts
                {{$negativePosts}}</a>
        </div>
        <div class="col">
            <a href="#" class="z-depth-3 waves-effect waves-light btn-large white-text">All posts {{$allPosts}}</a>
        </div>
        <div class="col">
            <a href="#" class="z-depth-3 waves-effect waves-light btn-large white-text">Positive posts
                {{$positivePosts}}</a>
        </div>
    </div>
    <?php foreach ($posts as $post):
        extract($post)?>
    <a href="/?post=<?= $post['post_id'] ?>">
        <div class="container">
            <div class="card darken-1">
                <div class="card-content">
                    <div class="text-black">
                        <p class="card-header"><?= $user_name?></p>
                        <p class="card-body"><?= $post_content ?></p>
                        <div class="d-flex card-footer">
                            <span class="flex-column col left-align"><?= round($rate_value, 1) ?></span>
                            <span class="flex-column col right-align"><?= $post_date ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
    <?php endforeach;?>
</body>
</html>
