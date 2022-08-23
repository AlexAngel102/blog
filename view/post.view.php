<?php if (is_array($posts)): foreach ($posts as $post): ?>
    <a href="/posts/?post=<?= $post['post_id'] ?>" class="text-black" data-link="post">
        <input type="hidden" id="postId" value="<?= $post['post_id'] ?>">
        <div class="card darken-1">
            <div class="card-content">
                <div class="text-black h-50">
                    <p class="card-title" name="visitore_name"><?= $post['visitore_name']; ?></p>
                    <div class="shorter" short-text>
                        <p class="card-body" name="post"><?= $post['post']; ?></p>
                    </div>

                    <?php include __DIR__ . '/ratestars.php' ?>
                    <!--    Rate wil be here    -->
                    <span class="flex-column col right-align p-3"
                          name="created_at"><?= $post['created_at']; ?></span>
                    <div class="d-flex">
                    </div>
                    <span data="block"></span>
                </div>
            </div>
        </div>
    </a>
<?php endforeach; endif; ?>
<div class="container right" id="comments" hidden>
</div>
