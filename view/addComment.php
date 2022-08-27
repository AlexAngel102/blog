<!-- Modal -->
<div class="modal fade reply" id="replyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="/addcomment" method="post" class="addCommentForm" id="addCommentForm" name="addCommentForm"">
                    <input hidden name="post_id" value="<?= $post['post_id'] ?>">
                    <label for="username">Name</label>
                    <input type="text" name="visitor_name" id="username" required minlength="1">
                    <label for="post">Your comment</label>
                    <textarea class="materialize-textarea" name="comment" id="post" required minlength="1" maxlength="250"></textarea>
                </form>
                <div class="d-flex right">
                <div class="flex-column px-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                <div class="px-3 flex-column">
                    <button type="submit" class="btn btn-primary commentBtn" form="addCommentForm" id="commentBtn" name="commentBtn">Apply</button>
                </div>
                <p></p>
            </div>
        </div>
    </div>
</div>