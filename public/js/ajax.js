$(document).ready(function () {
    $("#test").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            dataType: "html",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                let result = JSON.parse(data);

            }
        })
    })
})