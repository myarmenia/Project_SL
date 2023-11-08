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