//=================  edit function ===================//

// let editIcon = document.querySelectorAll('.etid-icon')
// function changInfo (e){
//     let allTd = e.target.closest('tr').querySelectorAll('td')
//     let closeBtn = document.querySelector('.close-btn')
//     let editBtn = document.querySelector('.edit-btn')
//     let editForm = document.querySelector('.translate-form')
//     closeBtn.addEventListener('click' , () => {
//         editForm.reset()
//     })

//     editBtn.addEventListener('click' , () => {
//         let inputs = editForm.querySelectorAll('input')
//         inputs[0].value !== '' && allTd[2].innerText !== '' ? allTd[2].innerText +=  `,${inputs[0].value}`: inputs[0].value !== ''  && allTd[2].innerText === ''  ? allTd[2].innerText +=  inputs[0].value : ''
//         inputs[1].value !== '' && allTd[3].innerText !== '' ? allTd[3].innerText +=  `,${inputs[1].value}` : inputs[1].value !== '' && allTd[3].innerText === ''  ? allTd[3].innerText +=  inputs[1].value : ''
//         inputs[2].value !== '' && allTd[4].innerText !== '' ? allTd[4].innerText +=  `,${inputs[2].value}`: inputs[2].value !== ''  && allTd[4].innerText === ''  ? allTd[4].innerText +=  inputs[2].value : ''
//         editForm.reset()
//     })
// }
// editIcon.forEach(el =>{
//     el.addEventListener('click' ,(e) =>  changInfo(e))
// })



// ================ translate fetch js ================= //

let select = null;

async function postDataTranslate(propsData, url, action_type) {
    const postUrl = url;

    try {
        const response = await fetch(postUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(propsData),
        });
        if (!response.ok) {
            throw new Error("Network response was not ok");
        } else {
            const responseData = await response.json();

            const data = responseData.data;

            if (action_type === "show_translate") {
                printResponseTranslate(data);
            } else if (action_type === "send_translate") {
                printCreateTable(responseData);
            } else if (action_type === "show-color") {
                // ==========
            }
        }
    } catch (error) {
        console.error("Error:", error);
    }
}

let translateSelect = document.querySelector(".translate-select");

translateSelect?.addEventListener("change", (e) => {
    let obj = {
        id: e.target.value,
    };

    postDataTranslate(obj, "/system-learning/filter", "show_translate");
});

// ================ translate fetch js end ============= //


// ================ create post js ==================== //

let sendBtn = document.querySelector(".translate-send-btn");

sendBtn.addEventListener("click", (e) => {
    select = e.target
        .closest(".add-translate-block")
        .querySelector(".create-translate-select");
    let input = e.target
        .closest(".add-translate-block")
        .querySelector(".create-translate-inp");
    let obj = {
        content: input.value,
    };
    postDataTranslate(obj, "/translate", "send_translate");
    input.value = "";
});

// ================ create post js end ================ //


// ================ print response =================== //

function printResponseTranslate(data) {
    let table_tbody = document.querySelector(".table tbody");
    table_tbody.innerHTML = "";

    for (let i = 0; i <= data.length; i++) {
        let tr = document.createElement("tr");
        tr.innerHTML = `
        <td>${data[i].id}</td>
        <td>${data[i].armenian}</td>
        <td>${data[i].russian}</td>
        <td>${data[i].english}</td>
        <td>${data[i].chapter.content}</td>
        <td><i class="bi bi-pencil-square etid-icon" title="խմբագրել" data-bs-toggle="modal" data-bs-target="#exampleModazl"></i></td>
        `;
        table_tbody.appendChild(tr);
    }
}

let cardBody = document.querySelector(".card-body");

function printCreateTable(data) {

    let activTable = document.querySelector(".table");

    if (activTable) {
        let tbody = activTable.querySelector("tbody");
        let trTd = document.createElement("tr");
        trTd.innerHTML = `
      <td><button class="btn btn-primary add-translate" onclick="createPost(this)">Հաստատել</button></td>
      <td class="input-td change-td" >${data.armenian}</td>
      <td class="input-td change-td" >${data.russian}</td>
      <td class="input-td change-td" >${data.english}</td>
      <td class="input-td" >${select.value}</td>
      <td style="text-align: center" ><i class="bi bi-trash3 open-delete " title="Ջնջել" onclick="deleteTr(this)"></i></td>
      `;
        tbody.appendChild(trTd);
        let changeTd = trTd.querySelectorAll('.change-td')
        console.log(changeTd);
        select.selectedIndex = 0;
    } else {

        let div = document.createElement("div");
        div.style = `
        overflow: auto;
        `;
        let table = document.createElement("table");
        let tbody = document.createElement("tbody");
        let thead = document.createElement("thead");

        table.className = "person_table table";
        table.style.marginTop = "30px";
        let trTh = document.createElement("tr");

        trTh.innerHTML = `
    <th></th>
    <th>Հայերեն</th>
    <th>Ռուսերեն</th>
    <th>Անգլերեն</th>
    <th>Տիպ</th>
    <th></th>
    `;

        thead.appendChild(trTh);
        table.appendChild(thead);

        let trTd = document.createElement("tr");
        trTd.innerHTML = `
    <td><button class="btn btn-primary add-translate"  onclick="createPost(this)">Հաստատել</button></td>
    <td class="input-td change-td" >${data.armenian}</td>
    <td class="input-td change-td" >${data.russian}</td>
    <td class="input-td change-td" >${data.english}</td>
    <td class="input-td" >${select.value}</td>
    <td style="text-align: center" ><i class="bi bi-trash3 open-delete" title="Ջնջել" onclick="deleteTr(this)"></i></td>
    `;
        tbody.appendChild(trTd);
        table.appendChild(tbody);
        div.appendChild(table);
        cardBody.appendChild(div);
        select.selectedIndex = 0;
    }
}

// ================ print response end ============ //



// ================ create post =============== //

function createPost(addBtn) {
    let selectoption = select.querySelectorAll("option");
    let id = null;
    let td = addBtn.closest("tr").querySelectorAll(".input-td");
    selectoption.forEach((el) => {
        if (el.innerText === td[3].innerText) {
            id = el.getAttribute("data-id");
        }
    });

    let obj = {
        armenian: td[0].innerText,
        russian: td[1].innerText,
        english: td[2].innerText,
        type: id,
    };
    postDataTranslate(obj, "/system-learning", "show-color");
}

// ============== create post end =============== //


// ============== delete tr function ============ //
function deleteTr(trashIcon) {
    console.log(trashIcon);
    trashIcon.closest("tr").remove();
}
// ============== delete tr function end ========= //

// ============== edit create page functon ======= //

let inputTd = document.querySelectorAll('.input-td')
console.log(inputTd);