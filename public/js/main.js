"use strict"

window.addEventListener('load', function (ev) {

    const postBlock = document.getElementById('postBlock');
    const postTemplate = document.getElementById('postTemplate');

    let post = document.querySelector("div.postModal");
    let postModal = bootstrap.Modal.getOrCreateInstance(post);

    function getAllPosts() {
        let amount;
        postBlock.replaceChildren('');
        $.get('/allposts', {}, function (data) {
            document.querySelector('#allposts').insertAdjacentHTML('beforeend',data.length);
            for (let result of data) {
                renderPost(result);
            }
        });
        return amount;
    }

    ('beforeend', getAllPosts());

    function renderPost(postItem) {
        const post = postTemplate.content.cloneNode(true);
        post.querySelector('a').setAttribute("href", `/posts/?post=${postItem.post_id}`);
        post.querySelector('[name=visitore_name]').textContent = postItem.visitore_name;
        post.querySelector('[name=post]').textContent = postItem.post;
        post.querySelector('#postId').setAttribute('id', `post${postItem.post_id}`);
        post.querySelector('input.postId').value = postItem.post_id;
        post.querySelector('[name=created_at]').textContent = postItem.created_at;
        postBlock.append(post);
        rating();
    }

    // getAllPosts();


    //
    // async function getRating(postID) {
    //     $.post('/getrate', {'post_id': postID}, await function (result) {
    //
    //     });
    // }
    //
    // function arraySum(array) {
    //     let sum = 0;
    //     for (let i = 0; i < array.length; i++) {
    //         sum += array[i];
    //     }
    //     return sum;
    // }

    const aAllPosts = document.querySelector("#allposts");
    aAllPosts.setAttribute('style', 'pointer-events:none');

    const postForm = document.querySelector('form.addPostForm');
    postForm.addEventListener('submit', function (event) {
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
                getAllPosts();
                postModal.hide();
            }
        });
    });

    $(document).on('click', 'a.post', function (e) {

        e.preventDefault();

        const commentBlock = document.getElementById('comments');
        const commentTemplate = document.getElementById('commentTemplate');

        let link = e.currentTarget.href;
        link = new URL(link);

        let aAllPosts = document.querySelector('#allposts');
        aAllPosts.style.cssText = '';

        document.querySelector("#addPostButton").setAttribute("hidden", 'true');


        aAllPosts.addEventListener('click', function (e) {
            e.preventDefault();
            aAllPosts.style.cssText = 'pointer-events:none';
            getAllPosts();
        });


        function getComments(link) {
            const postId = link.searchParams.get('post');
            postBlock.replaceChildren('');
            $.get("/posts/", {'post': postId}, function (result) {
                renderPost(result[0]);
                document.querySelector('#replyBtn').removeAttribute("hidden");
                document.querySelector('#commentPostId').value = postId;
                $.get('/getComments/', {'post': postId}, function (comments) {
                    const commentBlock = document.getElementById('comments');
                    commentBlock.replaceChildren('');
                    commentBlock.removeAttribute("hidden");
                    if (comments != null) {
                        for (let item of comments) {
                            renderComment(item);
                        }
                    } else {
                        commentBlock.innerHTML = "<div><h6>No comments yet</h6></div>";
                    }
                });
            });
        }

        getComments(link);

        function renderComment(commentItem) {
            const comment = commentTemplate.content.cloneNode(true);
            comment.querySelector('[name=visitore_name]').textContent = commentItem.visitore_name;
            comment.querySelector('[name=comment]').textContent = commentItem.comment;
            comment.querySelector('[name=created_at]').textContent = commentItem.created_at;
            commentBlock.append(comment);
        }

        $(document).on('submit', 'form.addCommentForm', function (ev) {
            ev.preventDefault();
            let reply = document.querySelector("div.replyModal");
            let replyModal = bootstrap.Modal.getOrCreateInstance(reply);
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                dataType: "html",
                contentType: false,
                cache: false,
                processData: false,
                success: function () {
                    commentBlock.replaceChildren('');
                    getComments(link);
                    replyModal.hide();
                }
            });
        });
    });

    function rating() {
        const ratings = document.querySelectorAll('.rating');

        if (ratings.length > 0) {
            initRatings();
        }

        function initRatings() {

            let ratingActive, ratingValue;

            for (let index = 0; index < ratings.length; index++) {
                const rating = ratings[index];
                initRating(rating);
            }


            function initRating(rating) {
                initRatingVars(rating);
                setRatingActiveWidth();
                if (rating.classList.contains('rating_set')) {
                    setRating(rating);
                }
            }

            function initRatingVars(rating) {
                ratingActive = rating.querySelector('.rating__active');
                ratingValue = rating.querySelector('.rating__value');
            }

            function setRatingActiveWidth(index = ratingValue.innerHTML) {
                const ratingActiveWidth = index / 0.05;
                ratingActive.style.width = `${ratingActiveWidth}%`;
            }


            function setRating(rating) {
                const ratingItems = rating.querySelectorAll('.rating__item');
                for (let index = 0; index < ratingItems.length; index++) {
                    let ratingItem = ratingItems[index];
                    ratingItem.addEventListener('mouseenter', function (e) {
                        initRatingVars(rating);
                        setRatingActiveWidth(ratingItem.value);
                    });
                    ratingItem.addEventListener('mouseleave', function (e) {
                        setRatingActiveWidth();
                    });
                    ratingItem.addEventListener('click', function (e) {
                        if (rating.dataset.ajax) {
                            setRatingValue(ratingItem.value, rating)
                        } else {
                            ratingValue.innerHTML = index;
                            setRatingActiveWidth();
                        }

                    });
                }
            }

            async function setRatingValue(value, rating) {
                const postID = rating.querySelector('input.postId').value;
                $.get('/ratepost', {'post_id': postID, 'rating': value}, await function (result) {
                    getRating(postID);
                });
            }

        }
    }
});
