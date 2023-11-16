// ========================= add File Function and show content file ==========================//
let fileInput = document.querySelector(".man-file-input");
const textarea = document.querySelector(".form-control-text");
let data_model_id = null
let data_type = null
let data_field_name = null
let div_col = null 
let dataFiledName = null
let modalBtn = document.querySelectorAll('.model-id')
modalBtn.forEach(el => el.addEventListener('click' , () => {
    div_col = el.closest('.btn-div').querySelector('.tegs-div')
    dataFiledName = el.getAttribute('data-fieldname')
}))

function processFile(file) {
    if (file.name.endsWith(".docx") || file.name.endsWith(".doc")) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = function (event) {
                mammoth
                    .extractRawText({arrayBuffer: event.target.result})
                    .then((result) => resolve(result.value))
                    .catch(reject);
            };

            reader.onerror = function () {
                reject(new Error("Ошибка при чтении файла"));
            };

            reader.readAsArrayBuffer(file);
        });
    } else if (file.name.endsWith(".txt")) {
        if (fileInput.files.length > 0) {
            let selectedFile = fileInput.files[0];
            let reader = new FileReader();
            reader.onload = function (event) {
                textarea.value = event.target.result;
            };
            reader.readAsText(selectedFile);
        }
    } else {
        alert('Ընտրեք միայն "doc", "docx", "txt" ֆորմատի ֆայլեր')
        closeFuncton()
    }
}

fileInput.addEventListener("change", async function () {
    try {
        const selectedFile = fileInput.files[0];
        const textContent = await processFile(selectedFile);
        if (textContent) {
            textarea.value = textContent;
        }
    } catch (error) {
        console.error("Произошла ошибка:", error.message);
        alert(
            "Произошла ошибка при обработке файла. Пожалуйста, выберите другой файл."
        );
    }
});

const addBtn = document.querySelector(".add-file-btn");

function craeteFileData() {
    let textArea = document.querySelector('textarea')
    const requestData = {
        type: data_type,
        value: textarea.value,
        fieldName: dataFiledName
    };
    if (requestData.text !== "") {
        fetch(updated_route, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(requestData),
        })
            .then(async (response) => {
                const message = await response.json()
                div_col.innerHTML = ''
                div_col.innerHTML += drowOneTag(parent_id,  message.result, dataFiledName,'20')
                closeFuncton()
                textArea.value = ''
            })
    }
    textArea.value = ''
}

addBtn.addEventListener("click", craeteFileData);

// ========================= cleare function =============================  //

let closeBtn = document.querySelector(".close-button");

function closeFuncton() {
    let formFile = document.querySelector(".file-form");
    textarea.value = "";
    formFile.reset();
}

closeBtn.addEventListener("click", closeFuncton);

// ===================== fetch post file =====================  //

const apiUrl = "https://jsonplaceholder.typicode.com/posts";

function postFile(requestData) {

    fetch(apiUrl, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(requestData),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then((data) => {
            console.log(data);
        })
        .catch((error) => {
            console.error("Fetch error:", error);
        });
    closeFuncton();
}

let addContentBtn = document.querySelectorAll('.model-id')
addContentBtn.forEach(el => {
    el.addEventListener('click' , () => {
        data_model_id = el.getAttribute('data-model-id')
        data_type = el.getAttribute('data-type')
        data_field_name = el.getAttribute('data-fieldName')
    })
})




function drowOneTag(parent_model_id,data,field_name,slice) {
    let text_length= data[field_name].split('')
    let m = text_length.slice(0,20).join('')
    let info = data[field_name]   
    return  `
        <div class="Myteg">

        <span class="info-block" data-info ='${info}' onclick = 'printInfo(this)' data-bs-toggle="modal" data-bs-target="#additional_information">
            ${text_length.length > slice ? (m + '...') : data[field_name]}</span>
    </div>`;

}

let info_span = document.querySelectorAll('.info-block')
info_span?.forEach(el => el.addEventListener('click',() => printInfo(el)))

function printInfo(span){
    div_col = span.closest('.btn-div').querySelector('.tegs-div')
    dataFiledName = span.closest('.btn-div').querySelector('button').getAttribute('data-fieldname')
    data_type = span.closest('.btn-div').querySelector('button').getAttribute('data-type')
    let info = span.getAttribute('data-info')
    let textArea = document.querySelector('.form-control-text')
    textArea.value = info
}


function sliceInfo(){
    let myteg = document.querySelectorAll('.Myteg')
    myteg?.forEach(el => {
        let spanInfo =  el.querySelector('span').innerText
        if(spanInfo.length > '20'){
            let info = spanInfo.slice(0,20) + '...'
            let span  = `
            <span class="info-block" data-info ='${spanInfo}' onclick = 'printInfo(this)' data-bs-toggle="modal" data-bs-target="#additional_information">
            ${info}</span>
            `
            el.innerHTML = span 
        }
    })
}
sliceInfo()





