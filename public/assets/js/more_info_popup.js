// ========================= add File Function and show content file ==========================//
const textarea = document.querySelector(".form-control-text");
const addBtn = document.querySelector(".add-file-btn");
const fileInput = document.querySelector(".attach-file-input");

const content = document.querySelector('.file-modal')
const textArea = content.querySelector('.text_area_modal')
const button = content.querySelector('.add-file-btn')

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
        const regex = /\/\/[^\/]+\/([^\/]+)/;
        const match = window.location.href.match(regex);

        const alertMsgs = {
            am : 'Ընտրեք միայն "doc", "docx", "txt" ֆորմատի ֆայլեր',
            ru : 'Выбирайте только файлы формата «doc», «docx», «txt».',
        }

        alert(alertMsgs[match[1]])
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
        alert(
            "Произошла ошибка при обработке файла. Пожалуйста, выберите другой файл."
        );
    }
});

document.querySelectorAll('.btn-close').forEach(el => {
    el.addEventListener('click',function (){
            console.log('close')
            content.querySelector('.text_area_modal').value = ''
        });
})

function craeteFileData()
{
    const id = this.getAttribute('data-delete-id')
    const el = document.getElementById('attach_file')

    const requestData = {
        type: el.getAttribute('data-type'),
        model: el.getAttribute('data-model'),
        fieldName: el.getAttribute('data-fieldname'),
        value: textarea.value,
    };

    let url;
    if (id){
        url = 'more_data/'+id
    }else {
        url = updated_route;
    }

    if (requestData.value) {
        fetch(url, {
            method: "PATCH",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(requestData),
        })
        .then(async (response) => {
            const message = await response.json()
            const tegsDiv = document.querySelector('.more_data .tegs-div-content')

            tegsDiv.innerHTML += drowTeg(parent_id, 'more_data', message.result, 'text','has_many',true, true)
            getQuery()
            closeFuncton()
            DelItem()
        })
    }
}


function getQuery(){

    document.querySelectorAll('.get-data').forEach(el => {
        el.addEventListener('click', function () {
            const element = el.closest('.Myteg').querySelector('.xMark');

            console.log(element)
            // const table = element.getAttribute('data-table')
            const id = element.getAttribute('data-delete-id')

            fetch(`${updated_route}/more_data/${id}`,{
                method: 'GET',
                headers: {'Content-Type':'application/json'},
            })
                .then(async res => {
                    const data = await res.json()
                    textArea.value = data.result
                    button.setAttribute('data-delete-id', id)
                })
        })
    })
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


getQuery()
