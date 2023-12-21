// ========================= add File Function and show content file ==========================//
const textarea = document.querySelector(".form-control-text");
const addBtn = document.querySelector(".add-file-btn");
const fileInput = document.querySelector(".attach-file-input");


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
            ru : 'rus text',
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


function craeteFileData() {
    const el = document.getElementById('attach_file')

    const requestData = {
        type: el.getAttribute('data-type'),
        model: el.getAttribute('data-model'),
        fieldName: el.getAttribute('data-fieldname'),
        value: textarea.value,
    };

    if (requestData.value) {
        fetch(updated_route, {
            method: "PATCH",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(requestData),
        })
            .then(async (response) => {
                const message = await response.json()
                console.log(message.result);
                const tegsDiv = document.querySelector('.more_data .tegs-div-content')
                console.log(tegsDiv)
                tegsDiv.innerHTML += drowTeg(parent_id, 'more_data', message.result, 'id','has_many',false)
                closeFuncton()
                DelItem()
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
