"use strict";

setTimeout(() => sessionStorage.clear(), 1000 * 60 * 60 * 24);

document.addEventListener("DOMContentLoaded", function (ev) {

    const aAllPosts = document.querySelector("#mainLink");
    const postBtn = document.querySelector("#addPostButton");
    const postBlock = document.getElementById("postBlock");
    const postTemplate = document.getElementById("postTemplate");
    const commentBlock = document.getElementById("comments");
    const commentTemplate = document.getElementById("commentTemplate");
    const post = document.querySelector("div.postModal");
    const postModal = bootstrap.Modal.getOrCreateInstance(post);
    const allPosts = document.querySelector("#allposts")
    const negative = document.querySelector("#negativePosts");
    const positive = document.querySelector("#positivePosts");
    const elem = document.querySelectorAll('.fixed-action-btn');
    M.FloatingActionButton.init(elem, {
        hoverEnabled: false,
    });
    const postForm = document.querySelector("form.addPostForm");
    const reply = document.querySelector("div.replyModal");
    const replyModal = bootstrap.Modal.getOrCreateInstance(reply);

    function clear() {
        if (postBlock.hasChildNodes()) {
            postBlock.replaceChildren('');
        }
    }

    async function getAllPosts() {
        clear();
        await $.get("/allposts", {}, async function (data) {
            allPosts.textContent = 0;
            allPosts.textContent = data.length;
            for (let result of data) {
                await renderPost(result);
            }
            raiting();
            positiveAndNegative();
        });
    }

    getAllPosts();


    function positiveAndNegative() {
        let node = document.getElementsByClassName('rating__value');
        let n = 0;
        let p = 0;
        for (let i = 0; i < node.length; i++) {
            let values = node.item(i);
            let value = values.innerHTML;
            if (value < 3 && value > 0) {
                n++;
            }
            if (value > 3) {
                p++;
            }
        }
        negative.textContent = n;
        positive.textContent = p;
    }

    async function renderPost(postItem) {
        const post = postTemplate.content.cloneNode(true);
        post.querySelector("a").setAttribute("href", `/posts/?post=${postItem.post_id}`);
        post.querySelector("[name=visitore_name]").textContent = postItem.visitore_name;
        post.querySelector("[name=post]").textContent = postItem.post;
        post.querySelector("input.postId").value = postItem.post_id;
        post.querySelector("[name=created_at]").textContent = postItem.created_at;
        const ratings = post.querySelector("div.rating__value");
        await $.get("/getrate/", {post: postItem.post_id}, function (data) {
            if (data) {
                const rate = arraySum(data) / data.length;
                ratings.textContent = rate.toFixed();
            } else {
                ratings.textContent = 0;
            }
        });
        postBlock.append(post);
    }

    function arraySum(array) {
        let sum = 0;
        for (let i = 0; i < array.length; i++) {
            sum += array[i];
        }
        return sum;
    }

    postForm.addEventListener("submit", function (event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr("action"),
            method: $(this).attr("method"),
            data: new FormData(this),
            dataType: "html",
            contentType: false,
            cache: false,
            processData: false,
            success: async function () {
                clear();
                await getAllPosts();
                postForm.querySelectorAll(".addPost").forEach((input) => (input.value = ""));
                postModal.handleUpdate();
                postModal.hide();
            },
        });
    });

    $(document).on("click", "a.post", async function (e) {
        e.preventDefault();

        clear();

        let link = e.currentTarget.href;
        link = new URL(link);

        aAllPosts.style.cssText = "";

        postBtn.setAttribute("hidden", true);

        async function getComments(link) {
            commentBlock.replaceChildren('');
            let postId = link.searchParams.get("post");
            commentBlock.replaceChildren("");
            await $.get("/posts/", {"post": postId}, async function (result) {
                await clear();
                await renderPost(result[0]);
                document.querySelector("#replyBtn").removeAttribute("hidden");
                document.querySelector("#commentPostId").value = postId;
                raiting();
                await $.get("/getComments/", {post: postId}, async function (comments) {
                    const commentBlock = document.getElementById("comments");
                    commentBlock.replaceChildren("");
                    commentBlock.removeAttribute("hidden");
                    document.querySelector("a.post").style.cssText =
                        "pointer-events:none";
                    if (comments != null) {
                        for (let item of comments) {
                            await renderComment(item);
                        }
                    } else {
                        commentBlock.innerHTML =
                            "<div class='p-3'><h6>No comments yet</h6></div>";
                    }
                    postId = null;
                });
            });
        }

        await getComments(link);

        function renderComment(commentItem) {
            const comment = commentTemplate.content.cloneNode(true);
            comment.querySelector("[name=visitore_name]").textContent = commentItem.visitore_name;
            comment.querySelector("[name=comment]").textContent = commentItem.comment;
            comment.querySelector("[name=created_at]").textContent = commentItem.created_at;
            commentBlock.append(comment);
        }


        $(document).on("submit", "form.addCommentForm", function (ev) {
            ev.preventDefault();
            $.ajax({
                url: $(this).attr("action"),
                method: $(this).attr("method"),
                data: new FormData(this),
                dataType: "html",
                contentType: false,
                cache: false,
                processData: false,
                success: async function () {
                    clear();
                    await getComments(link);
                    reply.querySelectorAll(".comment").forEach((input) => (input.value = ""));
                    replyModal.handleUpdate();
                    replyModal.hide();
                },
            });
        });
    });

    aAllPosts.addEventListener("click", async function (e) {
        e.preventDefault();
        clear();
        await getAllPosts();
        aAllPosts.style.cssText = "pointer-events:none";
        postBtn.removeAttribute("hidden");
        commentBlock.setAttribute("hidden", true);
    });

    function raiting() {
        const ratings = document.querySelectorAll(".rating");

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
                if (rating.classList.contains("rating_set")) {
                    setRating(rating);
                }
            }

            function initRatingVars(rating) {
                ratingActive = rating.querySelector(".rating__active");
                ratingValue = rating.querySelector(".rating__value");
            }

            function setRatingActiveWidth(index = ratingValue.innerHTML) {
                const ratingActiveWidth = index / 0.05;
                ratingActive.style.width = `${ratingActiveWidth}%`;
            }

            function setRating(rating) {
                const ratingItems = rating.querySelectorAll("[name=rating]");
                ratingItems.forEach(function (ratingItem) {
                    ratingItem.addEventListener("mouseenter", function (e) {
                        initRatingVars(rating);
                        setRatingActiveWidth(ratingItem.value);
                    });
                    ratingItem.addEventListener("mouseleave", function (e) {
                        setRatingActiveWidth();
                    });
                    ratingItem.addEventListener("click", function (e) {
                        setRatingValue(ratingItem.value, rating);
                        positiveAndNegative();
                    });
                });
            }

            async function setRatingValue(value, rating) {
                let postID = rating.querySelector("input.postId").value;
                const wasRated = sessionStorage.getItem('posts');
                let newRated = [];
                if (!wasRated) {
                    sessionStorage.setItem("posts", JSON.stringify(newRated));
                } else {
                    newRated = JSON.parse(wasRated);
                    if (newRated.includes(postID)) {
                        setRatingActiveWidth();
                        alert("You have already rated this post!");
                    } else {
                        await $.post('/ratepost/', {"post": postID, "rating": value}, function () {
                            $.get("/getrate/", {post: postID}, async function (data) {
                                if (data) {
                                    const rate = arraySum(data) / data.length;
                                    ratingValue.textContent = rate.toFixed();
                                } else {
                                    ratingValue.textContent = 0;
                                }
                            });
                            setRatingActiveWidth();
                        });
                        newRated = newRated.concat(postID);
                        sessionStorage.setItem("posts", JSON.stringify(newRated));
                    }
                }
            }
        }
    }
});