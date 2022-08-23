"use strict"

$(document).ready(function () {
    $("#addpost").submit(function (event) {
        event.preventDefault();
        console.log(event);
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            dataType: "html",
            contentType: false,
            cache: false,
            processData: false,
            success: function () {
                $.get('/',{},function (){
                    location.reload();
                });
            }
        })
    })
})