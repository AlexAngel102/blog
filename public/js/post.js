"use strict"

$(function () {

    $(' body ').clear;
    $.get('/allposts', {}, function (data) {
        $('#postBlock').clear;
        $("#postBlock").html(data);
        let comments = $("#comments");
        comments.attr('hidden', 'true');
    });

    $(document).on('submit', 'form.addPostForm', function (event) {
        event.preventDefault();
            $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            dataType: "html",
            contentType: false,
            cache: false,
            processData: false,
            success: function () {
                console.log("load after click add post");
                $.get('/allposts', {}, function (data) {
                    $("#postBlock").html(data);
                    $("div.show").remove();
                    $("body").attr("style","");
                });
            }
        });
    });

    $(function () {
        $(document).on('click', 'a.post', function (e) {

            e.preventDefault();

            const link = e.currentTarget.href;
            const url = new URL(link);
            const postID = url.searchParams.get('post');

            $("#addPostButton").remove();

            $.get(link, {}, function (post) {
                console.log("load after click on post");
                $("#postBlock").html(post);
                getComments();
            });

            function getComments() {
                $.get('/getComments/', {post: postID}, function (comments) {
                    let block = $("#replyBtn");
                    block.html('<button type="button" class="btn z-depth-3 white-text right" data-bs-toggle="modal" data-bs-target="#replyModal">Reply</button>');
                    $('#comments').clear;
                    let commentsBlock = $("#comments");
                    commentsBlock.removeAttr('hidden');
                    let title = "<p class='h3'>Comments</p>"
                    commentsBlock.html(title + comments);
                    $("a.post").removeAttr('href');
                    $(".shorter").removeClass("shorter");
                });
            }


            $(document).on('submit', 'form.addCommentForm', function (ev) {
                console.log("click add comment");
                ev.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    dataType: "html",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function () {
                        console.log("load after click add comment");
                        getComments();
                        $("div.show").remove();
                        $("body").attr("style","");
                    }
                });
            });
        });
    });
});