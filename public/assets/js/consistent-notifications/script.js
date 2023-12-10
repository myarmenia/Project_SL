$(document).ready(function() {
    $('.my-delete-item').on('click', function () {
        let id = $(this).attr('data-id');
        $('#row-id').val(id);
    });
});