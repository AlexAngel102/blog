"use strict"

$(document).ready(function () {
    $("a[data-link='post']").removeAttr('href');
    $("[short-text]").removeClass("shorter");
    let block = $("[data*='block']");
    block.after('<div class="btn z-depth-3 white-text right" id="reply" data-bs-toggle="modal" data-bs-target="#replyModal">Reply</div>');

    let postID = $('#postId').val();
    $.get('/getComments/', {post: postID}, function (data) {
        let comments = $("#comments");
        comments.removeAttr('hidden');
        let title = "<p class='h3'>Comments</p>"
        comments.html(title + data);

    })

    $("#addcomment").submit(function (event) {
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
                $.get('/getComments/', {post: postID}, function (data) {
                    let comments = $("#comments");
                    let title = "<p class='h3'>Comments</p>"
                    comments.html(title + data);
                })
            }
        })
    })

});