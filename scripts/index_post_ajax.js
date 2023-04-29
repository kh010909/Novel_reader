$(document).ready(function () {
    $(document).on('click', '.show-more', function () {
        var id = $(this).attr('id');
        $('.show-more').hide();
        $('.loading').show();
        $.ajax({
            type: 'POST',
            url: './index/post/post_ajax_handle.php',
            data: 'id=' + id,
            success: function (html) {
                $('#show-more-main' + id).remove();
                $('.post-list').append(html);
            }
        });
    });
});