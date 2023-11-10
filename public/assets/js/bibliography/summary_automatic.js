let fileInputAction = document.getElementById("file_id_action");
let fileUploadContentAction = document.querySelector(".file-upload_action");

fileInputAction.addEventListener("change", function () {
    let selectedFileAction = fileInputAction.files[0];
    if (selectedFileAction) {
        fileUploadContentAction.innerHTML =
            "Ընտրված ֆայլ: " + selectedFileAction.name;
    } else {
        fileUploadContentAction.innerHTML = "";
    }
});

// let fileInputEvent = document.getElementById("file_id_event");
// let fileUploadContentEvent = document.querySelector(".file-upload_event");

// fileInputEvent.addEventListener("change", function () {
//     let selectedFileEvent = fileInputEvent.files[0];
//     if (selectedFileEvent) {
//         fileUploadContentEvent.innerHTML =
//             "Ընտրված ֆայլ: " + selectedFileEvent.name;
//     } else {
//         fileUploadContentEvent.innerHTML = "";
//     }
// });

////--------------------------loader-------------------------
// Скрыть лоадер после загрузки страницы
document.addEventListener('DOMContentLoaded', function () {
  document.getElementById('loader').style.display = 'none';
});

document.getElementById('loader-id').addEventListener('click', ()=>{
  document.getElementById('loader').style.display = 'block';

})
