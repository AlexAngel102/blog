<?php if(is_array($posts)):foreach ($posts as $post):?>
<a href="/?post=<?=$post['post_id']?>" class="text-black">
    <div class="container">
        <div class="card darken-1">
            <div class="card-content">
                <div class="text-black">
                    <p class="card-group" id="visitore_name"><?=$post['user_name'];?></p>
                    <p class="card-body" id="post"><?=$post['post_content'];?></p>
                    <div class="d-flex">
                        <label class="col-form-label" for="rate">Rating</label>
                        <span class="flex-column col left-align p-3" id="rate"><?=round($post['rate_value'], 1);?></span>
                        <span class="flex-column col right-align p-3" id="created_at"><?=$post['post_date'];?></span>
                        <form action="/reply" method="post" name="post<?=$post['post_id']?>" hidden>
                        <button type="button" class="flex-column right-align z-depth-3 waves-effect waves-light btn-large white-text">Reply</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>
<?php endforeach?>
<?php else: http_response_code(404);
endif;?>
