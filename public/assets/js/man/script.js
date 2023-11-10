// ========================= add File Function and show content file ==========================//
let fileInput = document.querySelector(".man-file-input");
const textarea = document.querySelector(".form-control-text");

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
    let modelId = document
        .querySelector(".model-id")
        .getAttribute("data-model-id");
    let requestData = {};
    if (fileInput.files.length > 0) {
        requestData = {
            id: modelId,
            file: fileInput.files[0],
            text: textarea.value,
        };
    } else {
        requestData = {
            id: modelId,
            text: textarea.value,
        };
    }
    if (requestData.text !== "") {
        console.log(requestData)
        // postFile(requestData);
        console.log(requestData);
    } else {
        alert("Լրացրեք դաշտը");
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

// const formControl = document.querySelectorAll('.form-control')

const tegs = document.querySelectorAll('.Myteg span:nth-of-type(1)')


document.querySelector('.file-upload').addEventListener('change', function (data) {
    const apiUrl = this.getAttribute('data-name')
    const formData = new FormData();

    formData.append('value', data.target.files[0]);
    formData.append('_method', 'PUT');
    formData.append('type', this.getAttribute('data-type'));
    formData.append('fieldName', 'file');
    let message

    fetch(apiUrl, {
        method: "POST",
        body: formData,
    })
        .then(async (response) => {
            message = await response.json()
            const pivot_table_name = this.getAttribute('data-pivot-table')
            const field_name = this.getAttribute('data-fieldname')
            // const parent_modal_name = this.getAttribute('data-parent-model-name')
            const tegsDiv = this.closest('.col').querySelector('.tegs-div')

            // console.log(tag_modelName, parent_model_id, tag_name, parent_modal_name, parent_model_id, pivot_table_name, message.result, field_name)
            tegsDiv.innerHTML += drowTeg(parent_id, pivot_table_name, message.result, field_name)
        }).finally(() => {
        DelItem()
    })
})

function fetQuery(value, newInfo) {
    console.info(newInfo)
    if (value) {
        const newurl = document.getElementById('updated_route').value
        const requestOption = {
            method: 'PATCH',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(newInfo)
        }

        fetch(newurl, requestOption)
            .then(async res => {
                if (!res) {
                    console.log('error');
                } else {
                    const data = await res.json()
                    const result = data.message
                    console.log(result)
                }
            })
    }

}


const fullName = document.getElementById('fullName');

const inpClass = document.querySelectorAll('.my-teg-class');

function getFullName(inp) {
    fetch('/' + lang + '/man/' + parent_id + '/full_name')
        .then(async res => {
            if (!res.ok) {
                console.log('error');
                inp.value = ''
            } else {
                const data = await res.json()
                fullName.value = data.result
                inp.value = ''
            }
        })
}

inpClass.forEach(inp => {
    inp.addEventListener('blur', (e) => {

        if (inp.value) {
            setTimeout(getFullName(inp), 0)

            fetch('/' + lang + '/man/' + parent_id + '/full_name')
                .then(async res => {
                    if (!res.ok) {
                       console.log('error');
                        inp.value = ''
                    }
                    else {
                        const data = await res.json()
                        const result = data.result
                        fullName.value =  result
                        inp.value = ''
                    }
                })
        }
    });
});


