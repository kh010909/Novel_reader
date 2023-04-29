$(document).ready(function () {

    $edited_image_crop = $('#edited-picture-upload').croppie({ //#edited-picture-upload in post_edit/post_edit/edit_post_form_crop.php
        enableExif: true,
        viewport: {
            width: 1000,
            height: 750,
            type: 'square'
        },
        boundary: {
            width: 1200,
            height: 900
        }
    });

    $('#upload-edited-post-picture').on('change', function () { //#upload-edited-post-picture in post_edit/post_edit/edit_post_form.php
        var reader = new FileReader();
        reader.onload = function (event) {
            $edited_image_crop.croppie('bind', {
                url: event.target.result
            }).then(function () {
                console.log('jQuery bind complete');
            });
        }
        reader.readAsDataURL(this.files[0]);

        $('#modal-upload-post-picture-edit').modal('show'); //#modal-upload-post-picture-edit in post_edit/post_edit/edit_post_form_crop.php
    });

    $('#edit-post-crop-picture').click(function (event) { //#edit-post-crop-picture in post_edit/post_edit/edit_post_form_crop.php
        $edited_image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (response) {
            console.log(response);
            $.ajax({
                url: "./post_edit/post_edit/edit_post_form_handle.php",
                type: "POST",
                data: {
                    "image": response
                },
                success: function (data) {
                    $('#modal-upload-post-picture-edit').modal('hide');
                    $('#uploaded-edited-picture').attr('src', data); //#uploaded-edited-picture in post_edit/post_edit/edit_post_form.php
                }
            });
        })
    });
});