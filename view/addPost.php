<!-- Modal -->
<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Add post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/addpost" method="post" class="addPostForm" id="addPostForm" name="addPostForm">
                    <label for="username">Name</label>
                    <input type="text" name="visitor_name" id="username" required minlength="3">
                    <label for="post">Text</label>
                    <textarea class="materialize-textarea" name="post" id="post" required minlength="2"
                              maxlength="2048"></textarea>
                </form>
            </div>
            <div class="d-flex right">
                <div class="flex-column px-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                <div class="px-3 flex-column">
                    <button type="submit" class="btn btn-primary postBtn" form="addPostForm" id="postBtn" name="postBtn">Apply</button>
                </div>
                <p></p>
            </div>
        </div>
    </div>
</div>