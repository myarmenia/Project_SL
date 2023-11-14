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

async function postDataTranslate(propsData, url, action_type,tr) {
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
                printCreateTable(data);
            } else if (action_type === "show-color") {
                let addBtn = tr.querySelector('.add-translate')
                let changeTdBtn = tr.querySelector('.change-td-btn')
                changeTdBtn.querySelector('.open-delete').remove()
                changeTdBtn.innerHTML = `<i class="bi bi-pencil-square open-edit " onclick="editChilde(this)" data-id = ${responseData.id}></i>`
                addBtn.setAttribute('disabled','disabled')
                addBtn.style.backgroundColor = 'black'
                addBtn.style.color = '#FFFFFF'
                addBtn.innerText = 'Հաստատված'
                addBtn.style.fontSize = '14px'
                tr.style.backgroundColor = '#90bfd999'
            }else if (action_type === 'show-child' || action_type === 'add-child'){
                showChilde(responseData)
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
    console.log(data);
    let activTable = document.querySelector(".table");

    if (activTable) {

        let tbody = activTable.querySelector("tbody");
        let trTd = document.createElement("tr");
        trTd.innerHTML = `
      ${data.type ? '<td>Առկա</td>' : '<td><button class="btn btn-primary add-translate" onclick="createPost(this)">Հաստատել</button></td>' }
      <td class="input-td change-td" >${data.armenian}</td>
      <td class="input-td change-td" >${data.russian}</td>
      <td class="input-td change-td" >${data.english}</td>
      <td class="input-td" >${select.value}</td>
      ${data.type ? `<td style="text-align: center" class = "change-td-btn"><i class="bi bi-pencil-square open-edit " onclick="editChilde(this)" data-id = ${data.id}></i></td>` : '<td style="text-align: center" class = "change-td-btn"><i class="bi bi-trash3 open-delete " title="Ջնջել" onclick="deleteTr(this)"></i></td>' }
      `;

        tbody.appendChild(trTd);
        select.selectedIndex = 0;

        let td = trTd.querySelectorAll('.change-td')
        td.forEach(el => el.addEventListener('dblclick', () => dblEdit(el) ))

    } else {
        let div = document.createElement("div");
        div.style = `
        overflow: auto;
        padding-bottom: 20px;
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
        ${data.type ? '<td>Առկա</td>' : '<td><button class="btn btn-primary add-translate" onclick="createPost(this)">Հաստատել</button></td>' }
         <td class="input-td change-td" >${data.armenian}</td>
         <td class="input-td change-td" >${data.russian}</td>
         <td class="input-td change-td" >${data.english}</td>
         <td class="input-td" >${select.value}</td>
         ${data.type ? `<td style="text-align: center" class = "change-td-btn"><i class="bi bi-pencil-square open-edit " onclick="editChilde(this)" data-id = ${data.id}></i></td>` : '<td style="text-align: center" class = "change-td-btn"><i class="bi bi-trash3 open-delete " title="Ջնջել" onclick="deleteTr(this)"></i></td>' }
        `;
        tbody.appendChild(trTd);
        table.appendChild(tbody);
        div.appendChild(table);
        cardBody.appendChild(div);
        select.selectedIndex = 0;

        let td = trTd.querySelectorAll('.change-td')
        let button = trTd.children[0].querySelector('button')
        button ? td.forEach(el => el.addEventListener('dblclick', () => dblEdit(el) )) : ''
    }
}

// ================ print response end ============ //

// ================ dbl Click edit =============== //

function dblEdit(td){
    
    let buttonDisabled = td.closest('tr').querySelectorAll('td')[0].querySelector('button').getAttribute('disabled')
    if(!buttonDisabled){
        let changeInput = document.querySelector('.change-input')
        if(changeInput){
            let td = changeInput.closest('td')
            td.innerText = changeInput.value
        }
        let tdText = td.innerText
        let input = document.createElement('input')
        input.className = 'form-control change-input'
        input.width = '100%'
        input.value = tdText
        input.addEventListener('blur',() => chengInput(input,td))
        td.innerHTML = ''
        td.appendChild(input)
    }
    
}

function chengInput(input,td){
    let inputVal = input.value
    td.innerText = inputVal
}

document.addEventListener('click', (e) => {
    if(e.target.className !== 'form-control change-input'){
        let changeInput = document.querySelector('.change-input')
        if(changeInput){
            let td = changeInput.closest('td')
            td.innerText = changeInput.value
        }
    }

})


// ================ dbl Click edit end =========== //



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
        chapter_id: id,
        type:'parent'
    };

    postDataTranslate(obj, "/system-learning", "show-color",addBtn.closest("tr"));
}

// ============== create post end =============== //


// ============== delete tr function ============ //
function deleteTr(trashIcon) {
    trashIcon.closest("tr").remove();
}
// ============== delete tr function end ========= //


// ============== edit functon ======= //

function editChilde(editIcon){
   let  obj = {
    system_learning_id : editIcon.getAttribute('data-id')
   }
   postDataTranslate(obj,'/system-learning/get-child','show-child',editIcon)

   let childrenBlock = editIcon.closest('tbody').querySelector('.add-children-block')
    childrenBlock?.remove()
    let rect = document.querySelector('.table').getBoundingClientRect()
    let tableWidth = Math.floor(rect.width)
    let rowId = editIcon.getAttribute('data-id')
     let divHtml = `
     <div class="add-children-block"  style="width: ${tableWidth}">
 
          <div class="close-block">
             <i class="bi bi-x-lg close-btn" onclick = ' deleteCildrenBLock(this)'></i>
         </div>
          <div class="child-block">
           
          </div>
 
         <div class="input-block">
             <input type="text" placeholder="Text" class="form-control input-children" data-id = '${rowId}' onblur = 'editChildrenPost(this)'>
         </div>
 
     </div>
     `
     let tr = editIcon.closest('tr')
     tr.insertAdjacentHTML('afterend',divHtml)
}
function showChilde(data){
    let showUlchild = document.querySelector('.child-block ul')
    if(showUlchild){
        let li = document.createElement('li')
        li.innerText = data.name
        showUlchild.appendChild(li)
    }else if(data.length !== 0 && !showUlchild){
        let child_block = document.querySelector('.child-block')
        let ul = document.createElement('ul')
        data.forEach(el => {
            let li = document.createElement('li')
            li.innerText = el.name
            ul.appendChild(li)
        })
        child_block.appendChild(ul)
    }
}

function editChildrenPost(input){
    let obj = {
        name: input.value,
        system_learning_id: input.getAttribute("data-id"),
        type: "child",
    };

    input.value = ''
    postDataTranslate(obj, "/system-learning", "add-child")
}

function deleteCildrenBLock (closeIcon){
 closeIcon.closest('.add-children-block').remove()
}

// ========= edit functon end ======= //
