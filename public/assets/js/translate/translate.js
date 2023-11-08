
//=================  edit function ===================//

let editIcon = document.querySelectorAll('.etid-icon')
function changInfo (e){
    let allTd = e.target.closest('tr').querySelectorAll('td')
    let closeBtn = document.querySelector('.close-btn')
    let editBtn = document.querySelector('.edit-btn')
    let editForm = document.querySelector('.translate-form')
    closeBtn.addEventListener('click' , () => {
        editForm.reset()
    })

    editBtn.addEventListener('click' , () => {
        let inputs = editForm.querySelectorAll('input')
        inputs[0].value !== '' && allTd[2].innerText !== '' ? allTd[2].innerText +=  `,${inputs[0].value}`: inputs[0].value !== ''  && allTd[2].innerText === ''  ? allTd[2].innerText +=  inputs[0].value : ''
        inputs[1].value !== '' && allTd[3].innerText !== '' ? allTd[3].innerText +=  `,${inputs[1].value}` : inputs[1].value !== '' && allTd[3].innerText === ''  ? allTd[3].innerText +=  inputs[1].value : ''
        inputs[2].value !== '' && allTd[4].innerText !== '' ? allTd[4].innerText +=  `,${inputs[2].value}`: inputs[2].value !== ''  && allTd[4].innerText === ''  ? allTd[4].innerText +=  inputs[2].value : ''
        editForm.reset()
    })
}
editIcon.forEach(el =>{
    el.addEventListener('click' ,(e) =>  changInfo(e))
})

//======================= delete function =======================//

let deleteInfoBtn = document.querySelectorAll('.delete-icon')

function deletTranslateInfo (e){
    let allTd = e.target.closest('tr').querySelectorAll('td')
    console.log(allTd);
    allTd[2].innerText = ''
    allTd[3].innerText = ''
}

deleteInfoBtn.forEach(el => {
    el.addEventListener('click', (e) => deletTranslateInfo(e))
})

// ================ translate post js ================= //
let select = null;

async function postDataTranslate(propsData ,url,action_type) {
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
                console.log(responseData);
                if(action_type === 'show_translate'){
                    printResponseTranslate(data)
                }else{
                    // =====
                }

        }
    } catch (error) {
        console.error("Error:", error);
    }
}

let translateSelect = document.querySelector('.translate-select')

translateSelect?.addEventListener('change', (e) =>  {
    let obj = {
        id: e.target.value,
    }

    postDataTranslate(obj,'/system-learning/filter','show_translate')

})

// ================ translate post js end ============= //


// ================ create post js ==================== //

let sendBtn = document.querySelector('.translate-send-btn')

sendBtn?.addEventListener('click', (e) => {
    select = e.target.closest('.add-translate-block').querySelector('.create-translate-select')
    let input = e.target.closest('.add-translate-block').querySelector('.create-translate-inp')
    let obj = {
        input_value : input.value,
    }
    postDataTranslate(obj,'/translate','send_translate')
})



// ================ create post js end ================ //

// ================ print response ================ //

function printResponseTranslate (data) {
    let table_tbody = document.querySelector('.table tbody')
    table_tbody.innerHTML = ''
 for(let i = 0; i <= data.length ; i++){
     let tr = document.createElement('tr')
        tr.innerHTML = `
        <td>${data[i].id}</td>
        <td>${data[i].armenian}</td>
        <td>${data[i].russian}</td>
        <td>${data[i].english}</td>
        <td>${data[i].chapter.content}</td>
        <td><i class="bi bi-pencil-square etid-icon" title="խմբագրել" data-bs-toggle="modal" data-bs-target="#exampleModazl"></i></td>
        `
        table_tbody.appendChild(tr)
     
 }
}



// ================ print response end ============ //




