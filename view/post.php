<?php
?>
<div class="container">
    <div class="card darken-1">
        <div class="card-content">
            <div class="">
                <span class="card-title">{$userName}</span>
            </div>
            <p>I am a very simple card. I am good at containing small bits of information.
                I am convenient because I require little markup to use effectively.</p>
            <div class="container-fluid">
                <span class="">{$post_date}</span>
            </div>
        </div>
        <div class="card-action">
            <a href="#" class="btn-info">Add Comment</a>
        </div>
        <form action="/form" method="post">
            <input type="text" value="Aleksandr" name="name" hidden>
            <button type="submit">press me</button>
        </form>
    </div>
</div>
<script src="../js/getPosts.js"></script>