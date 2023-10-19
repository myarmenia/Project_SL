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
                    // console.log(result_object)
                    const model_name = data.model_name
                    document.getElementById('table_id').innerHTML = ''
                    const objMap = new Map(Object.entries(result_object));
                    objMap.forEach((item, key) => {
                        document.getElementById('table_id').append(drowTr(item.name, item.id, model_name))
                    })

                    append_data(obj)
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
                    var objMap = new Map(Object.entries(result_object));

                    objMap.forEach((item,key) => {
                        document.getElementById('table_id').append(drowTr(item, key, model_name))
                    })
                    append_data(obj)
                }
            }
        })

}


const plusIcon = document.querySelectorAll('.my-plus-class')
const addInputTxt = document.querySelectorAll('.addInputTxt')
const modal = document.querySelector('.modal')

plusIcon.forEach(plus => {
    plus.addEventListener('click', openModal)
})

function openModal() {
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
                var objMap = new Map(Object.entries(result_object));
                objMap.forEach((item) => {
                    document.getElementById('table_id').append(drowTr(item[fieldname_db], item.id, model_name))
                })
                // calling  append_data function and transfer this  which is plus button

                append_data(this)

            }
        })
        
}        



// separate function for appendin  object
function append_data(obj) {
    document.querySelectorAll('.addInputTxt').forEach((el) => {

        el.addEventListener('click', (e) => {
          // console.log(el.closest('tr').querySelector('.inputName'));
            const parent = obj.closest('.form-floating')
            const text_content = el.closest('tr').querySelector('.inputName').textContent
            const model_id = el.closest('tr').querySelector('.modelId').textContent
            const model_name = el.closest('tr').querySelector('.inputName').getAttribute('data-model')

            parent.querySelector('.fetch_input_title').value = text_content


            parent.querySelector('.fetch_input_title').focus()
            parent.querySelector('.fetch_input_title').setAttribute('data-modelid', model_id)
            parent.querySelector('.fetch_input_title').setAttribute('data-modelname', model_name)

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
        var opts = document.getElementById(datalist_id).childNodes

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

//===========================

function fetchInputTitle(el) {

    const get_table_name = el.closest('.form-floating').querySelector('.my-plus-class').getAttribute('data-table-name')
    const url = get_filter_in_modal + '?path=' + get_table_name;
   
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

                    // errorModal()
                    // console.log('error');
                    el.value = ''
                }
                else {
                    const data = await res.json()
                    const result = data.result

                    el.closest('.col').querySelector('datalist').innerHTML = ''
                    const objMap = new Map(Object.entries(result));
                    objMap.forEach((item, key) => {

                        const option = document.createElement('option')
                        option.innerText = item
                        option.setAttribute('data-modelid', key)
                        el.closest('.col').querySelector('datalist').appendChild(option)

                    })

                 }

             })
    }

}


const formControl = document.querySelectorAll('.form-control')
function CheckDatalistOption(inp) {
    // console.log(inp);
    let datList_id;
    if (inp.hasAttribute('list')) {
        datList_id = inp.getAttribute('list')
        const opt = document.getElementById(datList_id).querySelectorAll('option')

        opt.forEach(el => {
            if (el.value !== inp.value) {
                errorModal(result_search_dont_matched)

                inp.removeAttribute('data-modelid')
                inp.value = ''
                return false
            }

        })
    }
}

//   ================= nor em grel teg i pahy
const tegsDiv = document.querySelector('.tegs-div')
let current_tags = []

const check=document.querySelectorAll('.check_tag')
check.forEach(tag_el=>{
    current_tags.push(tag_el.getAttribute('data-delete-id'))

})


formControl.forEach(input => {
    input.addEventListener('blur', onBlur)
})




function onBlur() {

    if(this.value !== '' && this.value !== ' ' && this.hasAttribute('list')){
        console.log(444);
        CheckDatalistOption(this)
    }


    if (this.closest('.form-floating').querySelector('.my-plus-class') ) {
    
        fetchInputTitle(this)
    }

    let newInfo = {}
    if (this.classList.contains('intermediate')) {
        newInfo.intermediate = 1
        newInfo.model = this.getAttribute('data-model')
        newInfo.location = this.getAttribute('data-location')
        newInfo.table = this.getAttribute('data-table') ?? null
        newInfo.local = this.getAttribute('data-local') ?? null
    }


    if (this.value) {
        if (this.hasAttribute('data-modelid') && !this.classList.contains('intermediate')) {

            const get_model_id = this.getAttribute('data-modelid')
            newInfo = {
                value: get_model_id,
                fieldName: this.name
            }
        } else {
            newInfo = {
                ...newInfo,
                value: this.value,
                fieldName: this.name,
                table: this.getAttribute('data-table') ?? null
            }
        }
    }


    if (this.value && this.value !== ' ') {
        // console.log(111111)
        // console.log(this.value)
        // metodi anuny grel mecatarerov
        const requestOption = {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(newInfo)

        }


      CheckDatalistOption(this)

        if((!document.querySelector('.error-modal').classList.contains('activeErrorModal') && this.hasAttribute('list')) || !this.hasAttribute('list')){
            fetch(updated_route, requestOption)
                .then(async data =>{
                    if(!data.ok){
                        const validation = await data.json();

                    }else{
                        console.log(data.status)

                        if(data.status != 204){

                        
                            const message = await data.json()
                            if(message.errors){
                                console.log('EEERRROOORRR')
                                const objMap = new Map(Object.entries(message.errors));
                                objMap.forEach((item) => {
                                    item.forEach(el => errorModal(el))
                                })
                            }

                            if(this.name === 'country_id' || this.classList.contains('intermediate')){
                                const parent_modal_name = this.getAttribute('data-parent-model-name')
                                const pivot_table_name = this.getAttribute('data-pivot-table')
                                const tag_modelName = this.getAttribute('data-modelname')
                                const parent_model_id = this.getAttribute('data-parent-model-id')
                                const tag_id = this.getAttribute('data-modelid')

                                if(!current_tags.filter((c_tag) => c_tag === this.getAttribute('data-modelid') ).length > 0 && this.value !=='') {
                                    const tag_name = message.result.name

                                    current_tags.push(this.getAttribute('data-modelid') )

                                    tegsDiv.append(drowTeg(tag_modelName,tag_id,tag_name, parent_modal_name, parent_model_id,pivot_table_name))
                                    this.value = ''
                                }else{
                                    this.value = ''
                                }
                                DelItem()

                            }
                        }
                    }

                })

        }

    }
}



