<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/materialize.min.css" rel="stylesheet">
    <link href="../../css/extra.css" rel="stylesheet">

    <!-- JavaScript -->
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/materialize.min.js"></script>
    <script src="../../js/jquery-3.6.0.min.js"></script>
    <script src="../js/main.js"></script>

    <title>Blog</title>
</head>
<header></header>
<body>

<div class="container align-center">
    <div class="row container p-3">
        <div class="col row">
            <div class="z-depth-3 waves-effect waves-light btn-large white-text" style="pointer-events: none" id="negativePosts"><i class="material-icons left">thumb_down</i>Negative: </div>
        </div>
        <div class="col row">
            <a href="/" class="z-depth-3 waves-effect waves-light btn-large white-text allposts" id="allposts"><i class="material-icons left">list</i>All posts: </a>
        </div>
        <div class="col row">
            <div class="z-depth-3 waves-effect waves-light btn-large white-text" style="pointer-events: none" id="positivePosts"><i class="material-icons left">thumb_up</i>Positive: </div>
        </div>
    </div>

<div class="" id="postBlock">
</div>

<div class="fixed-action-btn">
    <button class="btn-floating btn-large red pulse modal-trigger addPostButton" id="addPostButton" data-bs-toggle="modal" data-bs-target="#postModal">
        <i class="large material-icons">mode_edit</i>
    </button>
    <script src="../../js/floatButton.js"></script>
</div>

<footer>
</footer>
    <!-- Add post  modal-->
    <div class="modal fade postModal" id="postModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Add post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/addpost" method="post" class="addPostForm" id="addPostForm" name="addPostForm">
                        <label for="username">Name</label>
                        <input type="text" name="visitor_name" required minlength="3">
                        <label for="post">Text</label>
                        <textarea class="materialize-textarea" name="post" required minlength="2"
                                  maxlength="1024"></textarea>
                    </form>
                </div>
                <div class="d-flex right">
                    <div class="flex-column px-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="px-3 flex-column">
                        <button type="submit" class="btn btn-primary postBtn" form="addPostForm" id="postBtn" name="postBtn">Apply</button>
                    </div>
                    <p></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Add comment modal -->
    <div class="modal fade replyModal" id="replyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="/addcomment" method="post" class="addCommentForm" id="addCommentForm" name="addCommentForm"">
                    <input type="hidden" name="post_id" class="postId" value="`${post_id}`">
                    <label for="username">Name</label>
                    <input type="text" name="visitor_name" required minlength="1">
                    <label for="post">Your comment</label>
                    <textarea class="materialize-textarea" name="comment" required minlength="1" maxlength="250"></textarea>
                    </form>
                    <div class="d-flex right">
                        <div class="flex-column px-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                        <div class="px-3 flex-column">
                            <button type="submit" class="btn btn-primary commentBtn" form="addCommentForm" id="commentBtn" name="commentBtn">Apply</button>
                        </div>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
