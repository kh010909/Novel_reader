function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#uploaded-article') //#uploaded-article in .image-area of post_edit/add_article_form/add_article_form.php
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}