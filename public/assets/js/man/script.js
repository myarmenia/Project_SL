// ========================= add File Function and show content file ==========================//
let fileInput = document.querySelector(".man-file-input");
const textarea = document.querySelector(".form-control-text");

function processFile(file) {
    if (file.name.endsWith(".docx") || file.name.endsWith(".doc")) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = function (event) {
                mammoth
                    .extractRawText({ arrayBuffer: event.target.result })
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
    }else{
      alert('Ընտրեք միայն "doc", "docx", "txt" ֆորմատի ֆայլեր')
      closeFuncton()
    }
}

fileInput.addEventListener("change", async function () {
    try {
        const selectedFile = fileInput.files[0];
        const textContent = await processFile(selectedFile);
        if(textContent){
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
    if (fileInput.files.length > 0 ) {
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


document.querySelector('.file-upload').addEventListener('change',function (data){
    console.log(event.files)
    // fetch(apiUrl, {
    //     method: "POST",
    //     headers: {
    //         "Content-Type": "application/json",
    //     },
    //     body: JSON.stringify(requestData),
    // })
    //     .then((response) => {
    //         if (!response.ok) {
    //             throw new Error(`HTTP error! Status: ${response.status}`);
    //         }
    //         return response.json();
    //     })
    //     .then((data) => {
    //         console.log(data);
    //     })
    //     .catch((error) => {
    //         console.error("Fetch error:", error);
    //     });
})

// formControl.forEach(input => {
//     input.addEventListener('blur', onBlur)
// })

// function onBlur() {
//     let newInfo = {}
//     if (this.classList.contains('intermediate')) {


//     } else {
//         if (this.closest('.form-floating').querySelector('.my-plus-class')) {
//             fetchInputTitle(this)
//         }

//         if (this.value) {
//             let newInfo = {};
//             if (this.hasAttribute('data-modelid')) {
//                 const get_model_id = this.getAttribute('data-modelid')

//                 newInfo.intermediate = 1
//             } else {
//                 newInfo = {
//                     ...newInfo,
//                     value: this.value,
//                     fieldName: this.name
//                 }
//             }
//         }
//     }
//     fetQuery(this.value, newInfo)
// }


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


const arr1 = [];
const arr2 = [];
const arr3 = [];
const fullName = document.getElementById('fullName');

const inpClass = document.querySelectorAll('.my-teg-class');

inpClass.forEach(inp => {
    inp.addEventListener('blur', (e) => {
        if(inp.value !== ''){
            if (inp.id === 'inputLastNanme4') {

                if(!arr1.includes(inp.value)){
                    arr1.push(inp.value);
                }

                // inp.value = '';
            } else if (inp.id === 'inputNanme4') {
                if(!arr2.includes(inp.value)){
                    arr2.push(inp.value);
                }
                // inp.value = '';
            } else if (inp.id === 'inputMiddleName') {
                if(!arr3.includes(inp.value)){
                    arr3.push(inp.value);
                }
                // inp.value = ''
            }
        }

        let temp = (arr1.length > 0 ? arr1 + ';' : '') + (arr2.length > 0 ? arr2 + ';' : '') + arr3 + ' '
        fullName.value = temp.slice(0, temp.length-1)
    });
});
