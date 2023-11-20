// const file = document.getElementById('file_id')
//
// file.addEventListener('change',(e) => {
//     document.querySelector('.file-name').textContent = file.files[0].name
// });


$(document).ready(function() {
    $('.my-delete-item').on('click', function () {
        let id = $(this).attr('data-id');
        $('#row-id').val(id);
    })
});