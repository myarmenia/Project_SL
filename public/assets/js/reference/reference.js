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


////language select /////
// let language_btn = document.querySelector(".language_btns")
// language_btn.addEventListener("change",(el)=>{
//   let phonetic_check = document.getElementById("contactChoice10")
//   console.log("phonetic_check",phonetic_check.checked);
//   console.log(el.target.value);
// })
