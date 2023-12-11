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
// document.addEventListener('DOMContentLoaded', function () {
//   document.getElementById('loader').style.display = 'none';
// });

// document.getElementById('loader-id').addEventListener('click', ()=>{
//   document.getElementById('loader').style.display = 'block';
//   document.body.classList.add('loading-background ');

// })
///////////////////////////////////loader bootstrap //////////////

function showLoaderFIle() {
    if (fileUploadContentAction.innerHTML !== "") {
        let loader_wrapper = document.createElement("div");
        loader_wrapper.id = "loader-wrapper";
        let loader = document.createElement("div");
        loader.id = "loader";
        loader_wrapper.appendChild(loader);
        document.body.appendChild(loader_wrapper);
    }
}

/* /////////////// end loader bootstrap /////////////// */
