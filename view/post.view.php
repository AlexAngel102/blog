<?php if (is_array($posts)): foreach ($posts as $post): ?>
    <div class="card darken-1 fade show post">
        <div class="card-content">
            <a href="/posts/?post=<?= $post['post_id'] ?>" class="text-black post">
                <div class="text-black">
                    <input type="hidden" id="postId" value="<?= $post['post_id'] ?>">
                    <p class="card-title" name="visitore_name"><?= $post['visitore_name']; ?></p>
                    <div>
                        <p class="card-body" name="post"><?= $post['post']; ?></p>
                    </div>
                </div>
            </a>
            <div>
                <?php require __DIR__ . '/rating.view.php' ?>
            </div>
            <!--    Rate wil be here    -->
            <div class="p-3"><span class="flex-column col right-align p-3" name="created_at"><?= $post['created_at']; ?></span></div>
            <div class="d-flex">
            </div>
            <span id="replyBtn"></span>
        </div>
    </div>
    </div>
<?php endforeach; endif; ?>
