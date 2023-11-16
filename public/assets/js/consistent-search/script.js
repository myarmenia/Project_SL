$(document).ready(function() {
    $('#library').select2({
        selectionCssClass: 'my-class-section'
    });
    $('#following').select2();

    $('.my-delete-item').on('click', function () {
        let id = $(this).attr('data-id');
        $('#row-id').val(id);
    })
});