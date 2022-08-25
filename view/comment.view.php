<?php if (is_array($comments)): foreach ($comments as $comment): ?>
        <div class="card darken-1">
            <div class="card-content">
                <div class="text-black h-50">
                    <p class="card-title" name="visitore_name"><?= $comment['visitore_name']; ?></p>
                    <div class="shorter" short-text>
                        <p class="card-body" name="comment"><?= $comment['comment']; ?></p>
                    </div>
                        <span class="flex-column col right-align p-3"
                              name="created_at"><?= $comment['created_at']; ?></span>
                    </div>
                </div>
            </div>
        </div>
<?php endforeach; ?>
<?php else: echo "<h6>No comments yet</h6>";
endif; ?>
