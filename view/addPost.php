<div class="fixed-action-btn">
    <button class="btn-floating btn-large red pulse" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        <i class="large material-icons">mode_edit</i>
    </button>
</div>
<script src="../js/floatButton.js"></script>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Add post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/addpost" method="post" id="addpost">
                <div class="modal-body">
                    <label for="username">Name</label>
                    <input type="text" name="visitor_name" id="username" required minlength="3">
                    <label for="post">Text</label>
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