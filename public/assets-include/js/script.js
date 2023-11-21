// function drowTr(newTr, key, model_name) {

//     const tr = document.createElement('tr')

//     const td1 = document.createElement('td')
//     td1.innerText = key
//     td1.classList.add('modelId')
//     tr.append(td1)

//     const td2 = document.createElement('td')

//     td2.innerText = newTr
//     td2.setAttribute('data-model', model_name)


//     td2.classList.add('inputName')
//     tr.append(td2)
//     const td3 = document.createElement('td')
//     const btn = document.createElement('button')
//     btn.textContent = 'Ավելացնել'
//     btn.classList.add('addInputTxt')
//     btn.classList.add('btn-primary')
//     btn.classList.add('btn')
//     btn.setAttribute('data-id', 1)
//     btn.setAttribute('data-bs-dismiss', 'modal')
//     btn.setAttribute('aria-label', 'Close')
//     td3.append(btn)
//     tr.append(td3)

//     return tr
// }

// function fetchInfo(obj) {
//     const addNewInfoBtn_modal = document.getElementById('addNewInfoBtn')
//     const addNewInfoInp = document.getElementById('addNewInfoInp')
//     const table_name = obj.getAttribute('data-table-name');

//     addNewInfoBtn_modal.addEventListener('submit', (e) => {
//         e.preventDefault()
//         const newBody = {
//             value: addNewInfoInp.value,
//             fieldName: addNewInfoInp.name,
//             table_name: table_name,
//         }
//         // console.log(newBody)
//         const requestOption = {
//             method: 'POST',
//             headers: { 'Content-Type': 'application/json' },
//             body: JSON.stringify(newBody)
//         }

//         fetch('/' + lang + '/create-table-field', requestOption)
//             .then(async res => {
//                 if (!res) {
//                     // console.log('error');
//                 }
//                 else {
//                     const data = await res.json()
//                     const result_object = data.result
//                     // console.log(result_object)
//                     const model_name = data.model_name
//                     document.getElementById('table_id').innerHTML = ''
//                     var objMap = new Map(Object.entries(result_object));
//                     objMap.forEach((item, key) => {
//                         document.getElementById('table_id').append(drowTr(item.name, item.id, model_name))
//                     })

//                     append_data(obj)
//                     document.getElementById('addNewInfoInp').value = ''
//                 }
//             })
//     })
// }

// ================oninput=========================================================================================
// transfer plus button  as obj working  filter in modal

// function fetchInfoInputEvent(obj) {

//     const table_name = obj.getAttribute('data-table-name')


//     const addNewInfoBtn = document.getElementById('addNewInfoBtn')

//     const addNewInfoInp = document.getElementById('addNewInfoInp')


//     addNewInfoBtn.addEventListener('input', (e) => {

//         e.preventDefault()

//         const requestOption = {
//             method: 'get',
//             headers: { 'Content-Type': 'application/json' },

//         }

//         fetch(get_filter_in_modal + '?path=' + table_name + "&name=" + addNewInfoInp.value, requestOption)
//             .then(async res => {

//                 if (!res) {
//                     // console.log('error');
//                 }
//                 else {

//                     const data = await res.json()
//                     const result_object = data.result
//                     document.getElementById('table_id').innerHTML = ''

//                     if (result_object) {
//                         const model_name = data.model_name
//                         var objMap = new Map(Object.entries(result_object));
//                         objMap.forEach((item, key) => {

//                             document.getElementById('table_id').append(drowTr(item, key, model_name))
//                         })
//                         append_data(obj)
//                     }
//                 }
//             })

//     })
// }




// const plusIcon = document.querySelectorAll('.my-plus-class')
// const addInputTxt = document.querySelectorAll('.addInputTxt')
// const modal = document.querySelector('.modal')
// const uniqInput = document.getElementById('item1')

// plusIcon.forEach(plus => {
//     plus.addEventListener('click', openModal)
// })

// function openModal() {
//     // ============== im grac mas start ===============
//     document.getElementById('addNewInfoInp').value = ''

//     const fieldname_db = this.getAttribute('data-fieldname')
//     const get_table_name = this.getAttribute('data-table-name')
//     const newBody = {
//         table_name: get_table_name
//     }

//     // console.log(newBody);
//     const requestOption = {
//         method: 'GET',
//         headers: { 'Content-Type': 'application/json' },

//     }
//     // get open_modal_url variable  from blade script to get table content
//     fetch(open_modal_url + "?table_name=" + get_table_name, requestOption)
//         .then(async res => {

//             if (!res) {
//                 // console.log('error');
//             }
//             else {

//                 const data = await res.json()
//                 const result_object = data.result
//                 const model_name = data.model_name

//                 // every time on open modal we clean input value
//                 document.getElementById('table_id').innerHTML = ''
//                 // getting object value and in map creating tr
//                 var objMap = new Map(Object.entries(result_object));

//                 objMap.forEach((item) => {

//                     document.getElementById('table_id').append(drowTr(item[fieldname_db], item.id, model_name))

//                 })
//                 // calling  append_data function and transfer this  which is plus button

//                 append_data(this)

//             }
//         })

//     // =============== im grac mas end =================
//     // in modal  make filter
//     fetchInfoInputEvent(this)
//     // in  modal  add row in table
//     fetchInfo(this)
// }


// separate function for appendin  object
// function append_data(obj) {
//     // console.log(obj)
//     document.querySelectorAll('.addInputTxt').forEach((el) => {
//         el.addEventListener('click', (e) => {
//             // console.log(el.closest('tr').querySelector('.inputName'));
//             const parent = obj.closest('.forForm')
//             const text_content = el.closest('tr').querySelector('.inputName').textContent
//             const model_id = el.closest('tr').querySelector('.modelId').textContent
//             const model_name = el.closest('tr').querySelector('.inputName').getAttribute('data-model')

//             parent.querySelector('.fetch_input_title').value = text_content
//             parent.querySelector('.fetch_input_title').focus()
//             parent.querySelector('.fetch_input_title').setAttribute('data-modelid', model_id)
//             parent.querySelector('.fetch_input_title').setAttribute('data-modelname', model_name)

//             if (parent.querySelector('.fetch_input_title').hasAttribute("dataInputId")) {
//                 let hiddenId = parent.querySelector('.fetch_input_title').getAttribute("dataInputId")
//                 document.getElementById(hiddenId).value = model_id;
//             }
//         })
//     })
// }

// // search in plus section
// const search_datalist = document.querySelectorAll('.input_datalists');
// const fetch_input_title = document.querySelectorAll('.fetch_input_title')

// fetch_input_title.forEach((el) => {

//     el.addEventListener('input', (e) => {
//         fetchInputTitle(el)
//     })

//     el.addEventListener('focus', (e) => {
//         fetchInputTitle(el)
//     })
// })

// ====== work with datalist
// const append_datalist_info = document.querySelectorAll('.get_datalist')
// append_datalist_info.forEach(inp => {


//     inp.addEventListener('change', (e) => {


//         let thisVal = inp.value
//         let datalist_id = inp.getAttribute('list')
//         let dataId = inp.closest('.forForm').querySelector('.my-plus-class').getAttribute('data-table-name')
//         var opts = document.getElementById(datalist_id).childNodes
//         const parent = inp.closest('.forForm')

//         for (var i = 0; i < opts.length; i++) {

//             if (opts[i].value === thisVal) {

//                 let p = opts[i].getAttribute('data-modelid');

//                 inp.setAttribute('data-modelid', p)
//                 inp.setAttribute('data-modelname', dataId)

//                 if (parent.querySelector('.fetch_input_title').hasAttribute("dataInputId")) {
//                     console.log(552233)
//                     let hiddenId = parent.querySelector('.fetch_input_title').getAttribute("dataInputId")
//                     document.getElementById(hiddenId).value = p;
//                 }
//                 break;
//             }
//         }
//     })
// })
//===========================


// function fetchInputTitle(el) {


//     const get_table_name = el.closest('.forForm').querySelector('.my-plus-class').getAttribute('data-table-name')
//     const parent = el.closest('.forForm')

//     if (parent.querySelector('.fetch_input_title').hasAttribute("dataInputId")) {

//         let hiddenId = parent.querySelector('.fetch_input_title').getAttribute("dataInputId")
//         document.getElementById(hiddenId).value = '';
//     }

//     const url = get_filter_in_modal + '?path=' + get_table_name;
//     // console.log(url);
//     const newTitle = {
//         name: el.value
//     }
//     // console.log(5555);
//     // console.log(url);
//     if (url) {
//         const requestOption = {
//             method: 'GET',
//             headers: { 'Content-Type': 'application/json' },
//         }

//         fetch(url + '&name=' + el.value, requestOption)
//             .then(async res => {
//                 if (!res.ok) {
//                     // errorModal()
//                     // console.log('error');
//                     el.value = ''
//                 }
//                 else {
//                     const data = await res.json()
//                     const result = data.result

//                     el.closest('.forForm').querySelector('datalist').innerHTML = ''
//                     const objMap = new Map(Object.entries(result));
//                     objMap.forEach((item, key) => {

//                         const option = document.createElement('option')
//                         option.innerText = item
//                         option.setAttribute('data-modelid', key)
//                         el.closest('.forForm').querySelector('datalist').appendChild(option)

//                     })

//                 }

//             })
//     }


// }

// ========================================================================================



function drowTr(newTr, key, model_name) {
    const tr = document.createElement('tr')
    const td1 = document.createElement('td')
    td1.innerText = key
    td1.classList.add('modelId')
    tr.append(td1)

    const td2 = document.createElement('td')

    td2.innerText = newTr
    td2.setAttribute('data-model', model_name)
    td2.classList.add('inputName')
    tr.append(td2)
    const td3 = document.createElement('td')
    const btn = document.createElement('button')
    btn.textContent = 'Ավելացնել'
    btn.classList.add('addInputTxt')
    btn.classList.add('btn-primary')
    btn.classList.add('btn')
    btn.setAttribute('data-id', 1)
    btn.setAttribute('data-bs-dismiss', 'modal')
    btn.setAttribute('aria-label', 'Close')
    td3.append(btn)
    tr.append(td3)

    return tr
}

const modal_info_btn = document.getElementById("addNewInfoBtn"); //  Find the element
modal_info_btn.onsubmit = fetchInfo; // Add onsubmit function to element

function fetchInfo(obj) {
    obj.preventDefault()
    const addNewInfoBtn_modal = document.getElementById('addNewInfoBtn')
    const addNewInfoInp = document.getElementById('addNewInfoInp')
    const table_name = addNewInfoInp.getAttribute('data-table-name');

        const newBody = {
            value: addNewInfoInp.value,
            fieldName: addNewInfoInp.name,
            table_name: table_name,
        }

        const requestOption = {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(newBody)
        }

        fetch('/' + lang + '/create-table-field', requestOption)
            .then(async res => {
                if (!res) {
                    // console.log('error');
                }
                else {
                    const data = await res.json()
                    const result_object = data.result
                    const model_name = data.model_name
                    document.getElementById('table_id').innerHTML = ''
                    const objMap = new Map(Object.entries(result_object));
                    objMap.forEach((item, key) => {
                        document.getElementById('table_id').append(drowTr(item.name, item.id, model_name))
                    })

                    append_data()
                    document.getElementById('addNewInfoInp').value = ''
                }
            })
}

// ================oninput=========================================================================================
// transfer plus button  as obj working  filter in modal
const modal_filter = document.getElementById("addNewInfoInp"); //  Find the element
    modal_filter.oninput = fetchInfoInputEvent; // Add oninput function to element

function fetchInfoInputEvent(e) {

    const table_name = document.getElementById('addNewInfoInp').getAttribute('data-table-name')
    const addNewInfoInp = document.getElementById('addNewInfoInp')
    e.preventDefault()

    const requestOption = {
        method: 'get',
        headers: { 'Content-Type': 'application/json' },
    }

    fetch(get_filter_in_modal + '?path=' + table_name + "&name=" + addNewInfoInp.value, requestOption)
        .then(async res => {
            if (!res) {
                console.log('error');
            }
            else {
                const data = await res.json()
                document.getElementById('table_id').innerHTML = ''

                if(data.result){

                    const result_object = data.result
                    const model_name = data.model_name

                    result_object.forEach(element => {

                        document.getElementById('table_id').append(drowTr(element.name, element.id, model_name))
                    });
                    append_data()
                }
            }
        })
}

const plusIcon = document.querySelectorAll('.my-plus-class')
const addInputTxt = document.querySelectorAll('.addInputTxt')
const modal = document.querySelector('.modal')
let plusBtn
plusIcon.forEach(plus => {
    plus.addEventListener('click', openModal)
})

function openModal() {
    plusBtn = this
    // ============== im grac mas start ===============
    document.getElementById('addNewInfoInp').value = ''
    document.getElementById('table_id').innerHTML = ''
    const fieldname_db = this.getAttribute('data-fieldname')
    const get_table_name = this.getAttribute('data-table-name')
    document.getElementById('addNewInfoInp').setAttribute('data-table-name', get_table_name)

    console.log(get_table_name+'+ic bacvox ');
    const newBody = {
        table_name: get_table_name
    }

    // console.log(newBody);
    const requestOption = {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' },
    }
    // get open_modal_url variable  from blade script to get table content
    fetch(open_modal_url + "?table_name=" + get_table_name, requestOption)
        .then(async res => {
            if (!res) {
                console.log('error');
                //   const validation = await res.json()
            }
            else {
                const data = await res.json()
                const result_object = data.result
                const model_name = data.model_name

                // every time on open modal we clean input value
                document.getElementById('addNewInfoInp').value = ''
                // getting object value and in map creating tr
                let objMap = new Map(Object.entries(result_object));
                objMap.forEach((item) => {
                    console.log(document.getElementById('table_id'))
                    document.getElementById('table_id').append(drowTr(item[fieldname_db], item.id, model_name))
                })
                // calling  append_data function and transfer this  which is plus button

                append_data()
            }
        })
}

function handleClick() {

    this.setAttribute('data-bs-dismiss', "modal")
    const get_table_name = document.getElementById('addNewInfoInp').getAttribute('data-table-name')
            const input = plusBtn.closest('.form-floating').querySelector('.form-control');
            const text_content = this.closest('tr').querySelector('.inputName').textContent
            const model_id = this.closest('tr').querySelector('.modelId').textContent
            const model_name = this.closest('tr').querySelector('.inputName').getAttribute('data-model')
            // const text_content = this.querySelector('.inputName').textContent
            // const model_id = this.querySelector('.modelId').textContent
            // const model_name = this.querySelector('.inputName').getAttribute('data-model')

            if(input.classList.contains('set_value')){
                input.closest('.form-floating').querySelector('.main_value').value = model_id;
            }

            input.value = text_content
            input.focus()
            input.setAttribute('data-modelid', model_id)
            input.setAttribute('data-modelname', model_name)
}



// separate function for appendin  object
function append_data() {
    document.querySelectorAll('.addInputTxt').forEach((el) => {

        el.addEventListener('click', handleClick)
    })

    document.getElementById('table_id').querySelectorAll('tr').forEach(el => {
        el.addEventListener('dblclick',(e)=>{
            e.target.closest('tr').querySelector('.addInputTxt').click()
        })
    })
}


const fetch_input_title = document.querySelectorAll('.fetch_input_title')

fetch_input_title.forEach((el) => {

    el.addEventListener('input', (e) => {
        if(!el.value){
            el.value = ''
        }
        fetchInputTitle(el)
    })

    el.addEventListener('focus', (e) => {
        fetchInputTitle(el)
    })
})


//   // ====== work with datalist
const append_datalist_info = document.querySelectorAll('.get_datalist')

append_datalist_info.forEach(inp => {

    inp.addEventListener('change', (e) => {

        let thisVal = inp.value
        let datalist_id = inp.getAttribute('list')
        let dataId = inp.closest('.col').querySelector('.my-plus-class').getAttribute('data-table-name')
        const opts = document.getElementById(datalist_id).childNodes;

        for (var i = 0; i < opts.length; i++) {
            if (opts[i].value === thisVal) {

                let p = opts[i].getAttribute('data-modelid');

                inp.setAttribute('data-modelid', p)
                inp.setAttribute('data-modelname', dataId)

                break;
            }
        }
  })
})

function disableCheckInput(el,disable = false){
    if (!el.disabled && el.getAttribute('data-disabled') && disable) {
        const toggleEl = document.getElementById(el.getAttribute('data-disabled'))
        toggleEl.disabled = !!disable
        const plus = toggleEl.closest('.form-floating').querySelector('.icon')
        if (plus) {
            plus.classList.toggle('my-plus-class')
            if (plus.hasAttribute("data-bs-toggle")) {
                plus.removeAttribute("data-bs-toggle")
            } else {
                plus.setAttribute("data-bs-toggle", "modal");
            }
        }
    }
}


//===========================

function fetchInputTitle(el) {
    console.log(el)
    const get_table_name = el.closest('.form-floating').querySelector('.my-plus-class').getAttribute('data-table-name')
    console.log(3333);
    console.log(get_table_name)
    const url = get_filter_in_modal + '?path=' + get_table_name;

   disableCheckInput(el,el.value)

    const newTitle = {
        name: el.value
    }
    if (url) {
        const requestOption = {
            method: 'GET',
            headers: { 'Content-Type': 'application/json' },
        }

        fetch(url + '&name=' + el.value, requestOption)
            .then(async res => {
                if (!res.ok) {
                    const message = await res.json()
                    const objMap = new Map(Object.entries(message.errors));
                    objMap.forEach((item) => {
                        item.forEach(el => errorModal(el))
                    })
                    el.value = ''
                }
                else {
                    const data = await res.json()
                    const result = data.result

                    el.closest('.col').querySelector('datalist').innerHTML = ''

                    result.forEach(element => {
                        const option = document.createElement('option')
                        option.innerText = element.name
                        option.setAttribute('data-modelid', element.id)
                        el.closest('.col').querySelector('datalist').appendChild(option)

                    })
                }
            })
    }
}

let inpValue = true
const saveInputData = document.querySelectorAll('.save_input_data')
function CheckDatalistOption(inp) {

    // let inpValue = true


    let datList_id;
    if (inp.hasAttribute('list')) {
        datList_id = inp.getAttribute('list')
        const opt = document.getElementById(datList_id).querySelectorAll('option')

        let optionValues = []

        opt.forEach(el => {
            optionValues.push(el.value)

        })

        let checkInpValue = optionValues.includes(inp.value)

        if (!checkInpValue) {
            errorModal(result_search_dont_matched)
            inp.value = ''
            inpValue = false
            blur()

        }

    }
}

//   ================= nor em grel teg i pahy
// const tegsDiv = document.querySelector('.tegs-div')
let current_tags = []

const check=document.querySelectorAll('.check_tag')
check.forEach(tag_el=>{
    current_tags.push(tag_el.getAttribute('data-delete-id'))
})


saveInputData.forEach(input => {
    input.addEventListener('blur', onBlur)
    input.addEventListener('keyup', onKeypress)
    disableCheckInput(input,input.value)
})


function onKeypress(e) {
    if (e.keyCode === 13) {
        console.log('------enter--------')
        this.blur()
    }
}

function onFocus(e){
    let nexTabIndex = e.getAttribute('tabindex')*1 + 1
    let nextElement = document.querySelector(`input[tabindex="${nexTabIndex}"]`)
        if(nextElement){
            document.querySelector(`input[tabindex="${nexTabIndex}"]`).focus()
        }
}

function onBlur(e) {
    console.log('--------blur-----')
    console.log(this);


    let newInfo = {}
    newInfo.type = this.getAttribute('data-type') ?? null
    // console.log(this.getAttribute('data-type'),'data-type');

    newInfo.model = this.getAttribute('data-model')?? null
    // console.log(this.getAttribute('data-model'),'data-model');



    newInfo.table = this.getAttribute('data-table') ?? null
    // console.log(this.getAttribute('data-table'),'data-table');

     disableCheckInput(this,this.value)
        if (this.value) {
            if(this.hasAttribute('list')){
                CheckDatalistOption(this)
            }
        }

        if (this.hasAttribute('data-modelid')) {

            const get_model_id = this.getAttribute('data-modelid')

            newInfo = {
                ...newInfo,
                value: get_model_id ?? this.value,
                fieldName: this.name
            }
            if(this.value=='' ){
                console.log('bbbbbbbbbbbb')
                newInfo.delete_relation=true

            }
        } else {
            newInfo = {
                ...newInfo,
                value: this.value,
                fieldName: this.name,
                table: this.getAttribute('data-table') ?? null
            }
            if(this.name=='file_comment'){
                console.log(88888);
                // console.log(this.closest('.Myteg').querySelector('.delete-items-from-db').getAttribute('data-delete-id'));
                if(this.value!=''){
                    newInfo.file_id=this.nextElementSibling.getAttribute('data-delete-id')
                    console.log(this.nextElementSibling.getAttribute('data-delete-id'));
                }

            }
        }

console.log(newInfo)
        const requestOption = {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(newInfo)

        }


        const pivot_table_name = this.getAttribute('data-pivot-table')
        const check = this.closest('.col')?.querySelectorAll('.check_tag')
        const field_name = this.getAttribute('data-fieldname')
        let current_tags = []

        let checkvalue;


        // if(['last_name','first_name','middle_name'].includes(pivot_table_name)){

        //     checkvalue = newInfo.value
        //     check.forEach(tag_el => {
        //         current_tags.push(tag_el.getAttribute('data-value'))
        //     })
        // }else{
        //     checkvalue = this.getAttribute('data-modelid')
        //     check.forEach(tag_el => {
        //         current_tags.push(tag_el.getAttribute('data-delete-id'))
        //     })
        // }


        const hasValue = current_tags.filter((c_tag) => { return  c_tag === checkvalue}).length

        // if ((!document.querySelector('.error-modal').classList.contains('activeErrorModal') && this.hasAttribute('list')) || !this.hasAttribute('list')) {
    if (!hasValue && inpValue) {

        fetch(updated_route, requestOption)
                .then(async data =>{
                    if(!data.ok){
                        const validation = await data.json();
                    }
                    else{
                        if(data.status !== 204){
                            const message = await data.json()

                            if(message.errors){
                                console.log('EEERRROOORRR')
                                const objMap = new Map(Object.entries(message.errors));
                                objMap.forEach((item) => {
                                    item.forEach(el => errorModal(el))
                                })
                                this.value=''
                            }
                            else{
                                console.log('fffffffff')
                                onFocus(this)
                            }
                            console.log('xxxxx')


                            if (this.name === 'country_id' || newInfo.type) {

                                const parent_model_id = parent_id
                                const tegsDiv = this.closest('.col').querySelector('.tegs-div .tegs-div-content')
                                if(tegsDiv){
                                    current_tags.push(this.getAttribute('data-modelid'))
                                    console.log(message.result + '//////////')
                                    // console.log(parent_model_id, pivot_table_name, message.result, field_name)
                                    tegsDiv.innerHTML += drowTeg(parent_model_id, pivot_table_name, message.result, field_name)
                                    this.value = ''
                                }


                                DelItem()
                            }
                        }
                    }

                })
        }

}


