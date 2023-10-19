// test //
let selectTranslate = document.querySelector('.translate-select')
selectTranslate.addEventListener('change', () => {
    let tableDiv = document.querySelector('.table_div')
    tableDiv.style = `
    display: block;
    opacity: 1;
    visibility: visible;
    `
    onMauseScrolTh()
})


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
    allTd[4].innerText = ''
}

deleteInfoBtn.forEach(el => {
    el.addEventListener('click', (e) => deletTranslateInfo(e))
})