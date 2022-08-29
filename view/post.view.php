    <div class="card darken-1 fade show post">
        <div class="card-content">
            <a href="/posts/?post=`${post_id'}`" class="text-black post">
                <div class="text-black">
                    <p class="card-title" name="visitore_name">`${visitore_name}`</p>
                    <div>
                        <p class="card-body" name="post">`${post}`</p>
                    </div>
                </div>
            </a>
            <div id="post`${post_id}`">
                <div class="rating rating_set" data-ajax="true">
                    <div class="rating__body">
                        <div class="rating__active"></div>
                        <div class="rating__items">
                            <input type="hidden" class="postId" value="`${post_id}`">
                            <input type="radio" class="rating__item" name="rating" value="1">
                            <input type="radio" class="rating__item" name="rating" value="2">
                            <input type="radio" class="rating__item" name="rating" value="3">
                            <input type="radio" class="rating__item" name="rating" value="4">
                            <input type="radio" class="rating__item" name="rating" value="5">
                        </div>
                    </div>
                    <div class="rating__value"></div>
                </div>
            </div>
            <div class="p-3"><span class="flex-column col right-align p-3" name="created_at">`${created_at}`</span></div>
            <div class="d-flex">
            </div>
            <span id="replyBtn"></span>
        </div>
    </div>
    </div>
<div class="container right" id="comments" hidden>
</div>