
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
    btn.textContent = lang_modal_full_screen
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
                // console.log('error');
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
const modal_inp_label = document.querySelector('.modal_inp_label')
let plusBtn
plusIcon.forEach(plus => {
    plus.addEventListener('click', openModal)
})

function openModal() {
    const inp_label = this.closest('.col').querySelector('label')

    modal_inp_label.textContent = inp_label.textContent
    let inp_label_val_arr = inp_label.textContent.split(')')
    let inp_label_val = inp_label_val_arr[1]
    modal_inp_label.textContent = inp_label_val.replaceAll('(', '')
 
    plusBtn = this
    // ============== im grac mas start ===============
    document.getElementById('addNewInfoInp').value = ''
    document.getElementById('table_id').innerHTML = ''
    const fieldname_db = this.getAttribute('data-fieldname')
    const get_table_name = this.getAttribute('data-table-name')
    document.getElementById('addNewInfoInp').setAttribute('data-table-name', get_table_name)

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


            if(input.classList.contains('set_value')){
                input.closest('.form-floating').querySelector('.main_value').value = model_id;
            }

            input.value = text_content

            input.focus()
            input.setAttribute('data-modelid', model_id)
            input.setAttribute('data-modelname', model_name)

            disableCheckInput(input,input.value)
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

document.querySelectorAll('input[data-disabled]').forEach(function(input) {
    disableCheckInput(input,input.value)
    input.addEventListener('input', function() {
        disableCheckInput(this,this.value)
    });
});

function disableCheckInput(el,disable = false){
    if (el.hasAttribute('data-disabled')){
        const toggleEl = document.getElementById(el.getAttribute('data-disabled'))
        const plus = toggleEl.closest('.form-floating').querySelector('.icon')
        if (!el.disabled && el.getAttribute('data-disabled') && disable) {
            toggleEl.disabled = !!disable
            if (plus) {
                plus.classList.toggle('my-plus-disable')
                if (plus.hasAttribute("data-bs-toggle")) {
                    plus.removeAttribute("data-bs-toggle")
                } else {
                    plus.setAttribute("data-bs-toggle", "modal");
                }
            }
        }else {
            toggleEl.disabled = false
            if(plus && plus.classList.contains('my-plus-disable')){
                plus.classList.remove('my-plus-disable')
            }
        }
    }
}


//===========================

function fetchInputTitle(el, fnName = null) {


    const get_table_name = el.closest('.form-floating').querySelector('.my-plus-class').getAttribute('data-table-name')
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
                    if(fnName == null){
                    const message = await res.json()
                    const objMap = new Map(Object.entries(message.errors));
                    objMap.forEach((item) => {
                        item.forEach(el => errorModal(el))
                    })
                    el.value = ''
                    el.focus()
                }
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
                    if(fnName == null){
                        getNextInput(el)
                    }
                }
            })
    }
}


const saveInputData = document.querySelectorAll('.save_input_data')
function CheckDatalistOption(inp) {
    let optionValues = []

    let datList_id;
    if (inp.hasAttribute('list')) {
        datList_id = inp.getAttribute('list')
        const opt = document.getElementById(datList_id).querySelectorAll('option')


        opt.forEach(el => {
            optionValues.push(el.value)

        })

        let checkInpValue = optionValues.includes(inp.value)

        if (!checkInpValue) {
            errorModal(result_search_dont_matched)
            inp.value = ''
            inp.focus()

        }

    }
}

//   ================= nor em grel teg i pahy
let current_tags = []

const check=document.querySelectorAll('.check_tag')
check.forEach(tag_el=>{
    current_tags.push(tag_el.getAttribute('data-delete-id'))
})


saveInputData.forEach(input => {
    input.addEventListener('blur', onBlur)
    input.addEventListener('keyup', onKeypress)



    input.addEventListener('focus', onFocus)
    if(input.classList.contains('fetch_input_title')){
        input.addEventListener('input', onInputFn)
    }

})

function onInputFn(e) {
    fetchInputTitle(this, 'input')
}


function onKeypress(e) {
    if (e.keyCode === 13) {
        if(this.classList.contains('fetch_input_title')){
            fetchInputTitle(this)
        }

        else{
            getNextInput(this)

        }

    }
}

function onFocus(){

    inputCurrentValue = this.value

    if(this.classList.contains('fetch_input_title')){
        fetchInputTitle(this, 'input')


    }

}

function getNextInput(e){

    let nexTabIndex = e.getAttribute('tabindex')*1 + 1
    let nextElement = document.querySelector(`input[tabindex="${nexTabIndex}"]`)

    if(document.querySelector('.error-modal').classList.contains('activeErrorModal')){
        document.querySelector('.my-close-error').click()
    }else{
        if(nextElement){
            document.querySelector(`input[tabindex="${nexTabIndex}"]`).focus()
        }
        else{
            e.blur()
        }
    }
}

let inputCurrentValue = ''
function onBlur(e) {
    console.log('--------blur-----')


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
                if(this.value!=''){
                    newInfo.file_id=this.nextElementSibling.getAttribute('data-delete-id')
                }

            }
        }

        const requestOption = {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(newInfo)
        }

        const pivot_table_name = this.getAttribute('data-pivot-table')
        const field_name = this.getAttribute('data-fieldname')
        console.log(field_name+'523');
        let current_tags = []

        let checkvalue;
        if(this.closest('.col')){
            const check = this.closest('.col')?.querySelectorAll('.check_tag')

        

        if(['last_name','first_name','middle_name',"signal_check_date"].includes(pivot_table_name)){
            console.log(pivot_table_name)
            checkvalue = newInfo.value
            check.forEach(tag_el => {
                current_tags.push(tag_el.getAttribute('data-value'))
            })
        }else{
            checkvalue = this.getAttribute('data-modelid') ?? null
            
            check.forEach(tag_el => {
                console.log('barev');
                current_tags.push(tag_el.getAttribute('data-delete-id'))
            })
        }

    }
    const hasValue = current_tags.some(c_tag => c_tag === checkvalue)
    console.log(hasValue, 'fffffff');
    console.log(!hasValue  ,this.value !== '',current_tags)
    // console.log(!hasValue  && inputCurrentValue !== '' || (inputCurrentValue === '' && this.value !== ''))
    if (!hasValue  && this.value !== '') {
        // console.log('--------fetch----')
        fetch(updated_route, requestOption)
                .then(async data =>{
                    if(!data.ok){
                        const validation = await data.json();
                    }
                    else{
                        if(data.status !== 204){
                            const message = await data.json()

                            if(message.errors){
                                const objMap = new Map(Object.entries(message.errors));
                                objMap.forEach((item) => {
                                    item.forEach(el => errorModal(el))
                                })
                                this.value=''
                                this.focus()
                            }

                            if (this.name === 'country_id' || newInfo.type) {
                                const parent_model_id = parent_id
                                const tegsDiv = this.closest('.col').querySelector('.tegs-div .tegs-div-content')
                                if(tegsDiv){

                                    current_tags.push(this.getAttribute('data-modelid'))
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


