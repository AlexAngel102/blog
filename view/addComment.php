<!-- Modal -->
<div class="modal fade" id="replyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">
            <form action="/addcomment" method="post" id="addcomment">
                <input hidden name="post_id" value="<?= $post['post_id'] ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <label for="username">Name</label>
                    <input type="text" name="visitor_name" id="username" required minlength="3">
                    <label for="post">Your comment</label>
                    <textarea name="post" id="post" required minlength="2" maxlength="2048"></textarea>
                </div>
                <div class="d-flex right">
                    <div class="flex-column px-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="px-3 flex-column">
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Apply</button>
                    </div>
                    <p></p>
                </div>
            </form>
        </div>
    </div>
</div>