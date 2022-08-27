"use strict"

import {rating} from "./rating.js";

$(function () {

    $("a.allposts").attr('style', 'pointer-events:none');

    function getAllPosts() {
        $.get('/allposts', {}, function (data) {
            $("#postBlock").html(data);
            $("#comments").attr('hidden', 'true');
            $("button.addPostButton").removeClass("hide");
            getRating();
        });
    }

    getAllPosts();

    function getRating() {
        const postLinks = document.querySelectorAll('a.post');
        for (let i = 0; i < postLinks.length; i++) {
            const link = postLinks[i].getAttribute('href');
            const url = new URL("http://"+link);
            const postID = url.searchParams.get('post');
            $.post('/getrate',{'post_id': postID}, function (result){
                const posts = document.querySelectorAll('div.post');
                const post = posts[i];

                post.querySelector('.rating__value').innerHTML = result;
                rating();
            });
        }
    }

    $(document).on('submit', 'form.addPostForm', function (event) {
        event.preventDefault();
        const post = document.querySelector("div.post");
        const postModal = bootstrap.Modal.getOrCreateInstance(post);
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            dataType: "html",
            contentType: false,
            cache: false,
            processData: false,
            success: function () {
                getAllPosts();
                postModal.hide();
            }
        });
    });

    $(function () {
        $(document).on('click', 'a.post', function (e) {

            e.preventDefault();

            $("a.allposts").removeAttr('style');

            $(document).on('click', 'a.allposts', function (e) {
                e.preventDefault();
                $("a.allposts").attr('style', 'pointer-events:none');
                getAllPosts();
            });

            const link = e.currentTarget.href;
            const url = new URL(link);
            const postID = url.searchParams.get('post');

            $("button.addPostButton").attr("hidden");

            function getComments() {
                $.get('/getComments/', {post: postID}, function (comments) {
                    let block = $("#replyBtn");
                    block.html('<button type="button" class="btn z-depth-3 white-text right" data-bs-toggle="modal" data-bs-target="#replyModal">Reply</button>');
                    let commentsBlock = $("#comments");
                    commentsBlock.removeAttr('hidden');
                    let title = "<p class='h3'>Comments</p>"
                    commentsBlock.html(title + comments);
                    $("a.post").attr('style', 'pointer-events:none');
                });
                getRating();
                rating();
            }

            $.get(link, {}, function (post) {
                $("#postBlock").html(post);
                getComments();
                $("button.addPostButton").addClass("hide");
            });

            $(document).on('submit', 'form.addCommentForm', function (ev) {
                ev.preventDefault();
                const reply = document.querySelector("div.reply");
                const replyModal = bootstrap.Modal.getOrCreateInstance(reply);
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    dataType: "html",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function () {
                        getComments();
                        replyModal.hide();
                    }
                });
            });
        });
    });
});