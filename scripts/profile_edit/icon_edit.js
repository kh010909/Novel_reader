$(document).ready(function () {
    $icon_crop = $('#icon-upload').croppie({
        enableExif: true,
        viewport: {
            width: 200,
            height: 200,
            type: 'square'
        },
        boundary: {
            width: 300,
            height: 300
        }
    });

    $('#upload-icon').on('change', function () {
        var icon_reader = new FileReader();
        icon_reader.onload = function (event) {
            $icon_crop.croppie('bind', {
                url: event.target.result
            }).then(function () {
                console.log('jQuery bind complete');
            });
        }
        icon_reader.readAsDataURL(this.files[0]);
        $('#modal-upload-icon').modal('show');
    });

    $('.crop_image').click(function (event) {
        $icon_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (response) {
            $.ajax({
                url: "./profile_edit/icon_edit/icon_form_handle.php",
                type: "POST",
                data: {
                    "icon": response
                },
                success: function (data) {
                    $('#modal-upload-icon').modal('hide');
                    $('#uploaded-icon').html(data);
                }
            });
        })
    });
});