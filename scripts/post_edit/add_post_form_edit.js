$(document).ready(function () {

    $image_crop = $('#picture-upload').croppie({ //#picture-upload in post_edit/add_post_form/add_post_form_crop.php
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

    $('#upload-post-picture').on('change', function () { //#upload-post-picture in post_edit/add_post_form/add_post_form.php
        var reader = new FileReader();
        reader.onload = function (event) {
            $image_crop.croppie('bind', {
                url: event.target.result
            }).then(function () {
                console.log('jQuery bind complete');
            });
        }
        reader.readAsDataURL(this.files[0]);

        $('#modal-upload-post-picture').modal('show'); //#modal-upload-post-picture in post_edit/add_post_form/add_post_form_crop.php
    });

    $('.crop_picture').click(function (event) { //.crop_picture in post_edit/add_post_form/add_post_form_crop.php
        $image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (response) {
            $.ajax({
                url: "./post_edit/add_post_form/add_post_form_handle.php",
                type: "POST",
                data: {
                    "image": response
                },
                success: function (data) {
                    $('#modal-upload-post-picture').modal('hide');
                    $('#uploaded-picture').html(data);
                }
            });
        })
    });
});