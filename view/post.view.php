<?php if (is_array($posts)): foreach ($posts as $post): ?>
    <div class="card darken-1">
        <div class="card-content">
            <a href="/posts/?post=<?= $post['post_id'] ?>" class="text-black post">
                <div class="text-black">
                    <input type="hidden" id="postId" value="<?= $post['post_id'] ?>">
                    <p class="card-title" name="visitore_name"><?= $post['visitore_name']; ?></p>
                    <div class="shorter" short-text>
                        <p class="card-body" name="post"><?= $post['post']; ?></p>
                    </div>
            </a>

            <?php //include __DIR__ . '/ratestars.php' ?>
                    <!--    Rate wil be here    -->
                    <div class="p-3"><span class="flex-column col right-align p-3"
                                           name="created_at"><?= $post['created_at']; ?></span></div>
                    <div class="d-flex">
                    </div>
            <span id="replyBtn"></span>
        </div>
    </div>
    </div>
<?php endforeach; endif; ?>
