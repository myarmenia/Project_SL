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


function craeteFileData() {
    const el = document.getElementById('attach_file')

    const requestData = {
        type: el.getAttribute('data-type'),
        model: el.getAttribute('data-model'),
        // table: el.getAttribute('data-model'),
        fieldName: el.getAttribute('data-fieldname'),
        value: textarea.value,
    };

    if (requestData.text !== "") {
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
                const tegsDiv = document.querySelector('.more_data')
                tegsDiv.innerHTML += drowTeg(parent_id, 'more_data', message.result, 'id')
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
