const file = document.getElementById('file_id')

file.addEventListener('change',(e) => {
    document.querySelector('.file-name').textContent = file.files[0].name
})