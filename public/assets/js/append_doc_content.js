// ========================= add File Function and show content file ==========================//
let fileInput = document.querySelector(".man-file-input");
const textarea = document.querySelector(".form-control-text");
let data_model_id = null
let data_type = null
let data_field_name = null

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
    const requestData = {
        type: data_type,
        value: textarea.value,
        fieldName: data_field_name
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

                console.log(message.result);
                const tegsDiv = document.querySelector('.more_data')
                tegsDiv.innerHTML += drowOneTag(parent_id,  message.result, 'content','20')
                closeFuncton()
            })
    }
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


    console.log("ARM");
    return  `

        <div class="Myteg">
            <input hidden name="{{$inputName}}" value="{{$item['id']}}">
            <span class="">
                ${text_length.length > slice ? (m + '...') : data[field_name]}</span>
        </div>`;

}





