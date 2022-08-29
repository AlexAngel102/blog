"use strict"

window.addEventListener('load', function (ev) {

    const body = ev.target.body;

    function getAllPosts() {
        $.get('/allposts', {}, function (data) {
            document.getElementById('postBlock').innerHTML;
            let postIds = document.querySelectorAll('input.postId');
            for (let i = 0; i < postIds.length; i++) {
                let postID = postIds[i].value;
                document.getElementById("comments").setAttribute('hidden', 'true');
                document.querySelector("button.addPostButton").classList.remove("hide");
                rating();
                getRating(postID);
            }
        });
    }

    getAllPosts();

    async function getRating(postID) {
        $.post('/getrate', {'post_id': postID}, await function (result) {
            if (result) {
                setTimeout(() => {
                    let post = document.getElementById(`post${postID}`)
                    console.log(post)
                    let block = post.getElementsByClassName('rating__value');
                    let res = JSON.parse(result)
                    let rating = arraySum(res) / res.length;
                    if (res == 0) {
                        block.innerHTML = 0;
                    } else {
                        let num = rating.toFixed(1);
                        block.innerHTML = num;
                    }
                }, 100)
            }
        });
    }

    function arraySum(array) {
        let sum = 0;
        for (let i = 0; i < array.length; i++) {
            sum += array[i];
        }
        return sum;
    }

    const aAllPosts = document.querySelector("a.allposts");
    aAllPosts.setAttribute('style', 'pointer-events:none');

    const postForm = document.querySelector('form.addPostForm');
    postForm.addEventListener('submit', function (event) {
        event.preventDefault();
        let post = document.querySelector("div.postModal");
        let postModal = bootstrap.Modal.getOrCreateInstance(post);
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
        getComments();


        let aAllPosts = document.querySelector('a.allposts');

        aAllPosts.style.cssText = '';
        let aPost = document.querySelector('a.post');

        aAllPosts.addEventListener('click', function (e) {
            e.preventDefault();
            aAllPosts.style.cssText = 'pointer-events:none';
            getAllPosts();
        });

        const link = e.currentTarget.href;

        document.querySelector("button.addPostButton").setAttribute("hidden", 'true');

        function getComments() {
            let post = document.querySelector('input.postId');
            let postID = post.getAttribute('value');
            $.get('/getComments/', {post: postID}, async function (comments) {
                if (comments) {
                    setTimeout(() => {
                        let block = document.getElementById('replyBtn');
                        block.innerHTML = '<button type="button" class="btn z-depth-3 white-text right" data-bs-toggle="modal" data-bs-target="#replyModal">Reply</button>';
                        let commentsBlock = $("#comments");
                        commentsBlock.removeAttr('hidden');
                        let title = "<p class='h3'>Comments</p>"
                        commentsBlock.html(title + comments);
                        aPost.setAttribute('style', 'pointer-events:none');
                        getRating(postID);
                        rating();
                    }, 100);
                }
            });
        }

        $.get(link, {}, function (post) {
            document.getElementById("postBlock").innerHTML = post;
            document.querySelector("button.addPostButton").classList.add("hide");
        });

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
                $.post('/ratepost', {'post_id': postID, 'rating': value}, await function (result) {
                    getRating(postID);
                });
            }

        }
    }
});
