function drowTr(newTr, key, model_name) {
    console.log(model_name);

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


function fetchInfo(obj) {

    const addNewInfoBtn = document.getElementById('addNewInfoBtn')

    const addNewInfoInp = document.getElementById('addNewInfoInp')
    console.log(addNewInfoInp)

    addNewInfoBtn.addEventListener('submit', (e) => {
        e.preventDefault()
        const newBody = {
            name: addNewInfoInp.value
        }

        const requestOption = {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(newBody)
        }


        fetch(url, requestOption)
            .then(async res => {
                if (!res) {
                    console.log('error');
                } else {
                    const {data} = await res.json()

                    data.forEach(el => drowTr(el))

                }
            })

    })
}

// ================oninput=========================================================================================
// transfer plus button  as obj

function fetchInfoInputEvent(obj) {

    const url = obj.getAttribute('data-url')
    // console.log(url);

    const addNewInfoBtn = document.getElementById('addNewInfoBtn')

    const addNewInfoInp = document.getElementById('addNewInfoInp')


    addNewInfoBtn.addEventListener('input', (e) => {
        e.preventDefault()
        const newBody = {
            name: addNewInfoInp.value
        }

        const requestOption = {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(newBody)
        }


        fetch(url, requestOption)
            .then(async res => {

                if (!res) {
                    console.log('error');
                } else {

                    const data = await res.json()
                    const result_object = data.result
                    const model_name = data.model_name
                    document.getElementById('table_id').innerHTML = ''
                    var objMap = new Map(Object.entries(result_object));
                    objMap.forEach((item, key) => {
                        document.getElementById('table_id').append(drowTr(item, key, model_name))
                    })

                    append_data(obj)


                }
            })

    })
}


const plusIcon = document.querySelectorAll('.my-plus-class')
const addInputTxt = document.querySelectorAll('.addInputTxt')
const modal = document.querySelector('.modal')
const uniqInput = document.getElementById('item1')

plusIcon.forEach(plus => {

    plus.addEventListener('click', openModal)
})

function openModal() {

    // ============== im grac mas start ===============
    document.getElementById('addNewInfoInp')?.value;
    const get_url = this.getAttribute('data-section')

    const get_table_name = this.getAttribute('data-id')

    const fieldname = this.getAttribute('data-fieldname')

    const newBody = {
        table_name: get_table_name
    }
    console.info('url', get_url, newBody)

    const requestOption = {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(newBody)
    }
    fetch(get_url, requestOption)
        .then(async res => {

            if (!res) {
                console.log('error');
            } else {

                const data = await res.json()
                const result_object = data.result
                const model_name = data.model_name
                // const section_id = data.section_id

                // every time on open modal we clean input value
                document.getElementById('table_id').innerHTML = ''
                // getting object value and in map creating tr
                var objMap = new Map(Object.entries(result_object));
                objMap.forEach((item) => {
                    // console.log(item.id)
                    document.getElementById('table_id').append(drowTr(item[fieldname], item.id, model_name))
                })
                // calling  append_data function and transfer this  which is plus button
                append_data(this)

            }
        })

    // =============== im grac mas end =================

    fetchInfoInputEvent(this)
    fetchInfo(this)
}

// separate function for appendin  object
function append_data(obj) {
    // console.log(obj)
    document.querySelectorAll('.addInputTxt').forEach((el) => {

        el.addEventListener('click', (e) => {
            // console.log(el.closest('tr').querySelector('.inputName').getAttribute('data-model'))

            const parent = obj.closest('.form-floating')
            const text_content = el.closest('tr').querySelector('.inputName').textContent
            const model_id = el.closest('tr').querySelector('.modelId').textContent
            const model_name = el.closest('tr').querySelector('.inputName').getAttribute('data-model')

            parent.querySelector('input').value = text_content
            parent.querySelector('input').setAttribute('data-modelid', model_id)
            parent.querySelector('input').setAttribute('data-modelname', model_name)


        })

    })

}


// tag script

// tag script


// search in plus section
const search_datalist = document.querySelectorAll('.input_datalists');
const fetch_input_title = document.querySelectorAll('.fetch_input_title')

fetch_input_title.forEach((el) => {
    // console.log(el.list)
    //   let datalist = el.list
    el.addEventListener('input', () => {
        // console.log(el.value)
        fetchInputTitle(el)
    })
})


//===============   fetch input end =======================

fetch_input_title.forEach((el) => {
    let datalist = el.list
    el.addEventListener('click', () => {
        fetchInputTitle(el)
    })
})
// ====== work with datalist
const fetch_input_title1 = document.querySelectorAll('.fetch_input_title')

fetch_input_title1.forEach(inp => {
    inp.addEventListener('change', (e) => {
        let thisVal = inp.value
        let datalist_id = inp.getAttribute('list')
        let dataId = inp.closest('.col').querySelector('.my-plus-class').getAttribute('data-id')
        console.log(dataId);
        var opts = document.getElementById('' + datalist_id).childNodes

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

    const url = el.closest('.form-floating').querySelector('.my-plus-class').getAttribute('data-url');
    const newTitle = {
        name: el.value
    }


    const requestOption = {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(newTitle)
    }


    fetch(url, requestOption)
        .then(async res => {
            if (!res) {
                console.log('error');
            } else {
                const data = await res.json()
                const result = data.result

                el.closest('.col').querySelector('datalist').innerHTML = ''
                const objMap = new Map(Object.entries(result));
                objMap.forEach((item, key) => {

                    const option = document.createElement('option')
                    option.innerText = item
                    option.setAttribute('data-modelid', key)
                    el.closest('.col').querySelector('datalist').appendChild(option)
                    option.addEventListener('click', (e) => {

                        // el.closest('.col').querySelector('fetch_input_title').setAttribute('data-modelid', key)
                    })
                })
                errorModal(result.length)

            }

        })


}

// ========================================================================================


const formControl = document.querySelectorAll('.form-control')

const tegs = document.querySelectorAll('.Myteg span:nth-of-type(1)')
//   console.log(tegs);

formControl.forEach(input => {

    input.addEventListener('blur', onBlur)
})

function onBlur() {

    console.log(this);
    let newInfo = {}


    formControl.forEach(input => {
        if (input.value) {
            if (input.hasAttribute('data-modelid')) {
                const get_model_id = input.getAttribute('data-modelid')


                newInfo = {

                    value: get_model_id,
                    fieldName: input.name


                }
            } else {
                newInfo = {
                    value: input.value,
                    fieldName: input.name

                }

            }
        }
    })

    console.log(newInfo);

    const requestOption = {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(newInfo)
    }


    fetch('model-update/?id=' + url_id + '&&table_name=' + table_name, requestOption)
        .then(async res => {
            if (!res) {
                console.log('error');
            } else {
                const data = await res.json()
                const result = data.message
                console.log(result)


            }
        })


}

// =========================================================================================

const errModal = document.getElementById('errModal')


function errorModal(dataLength) {
    document.querySelectorAll('.fetch_input_title').forEach(inp => {
        inp.addEventListener('blur', (e) => {
            if (dataLength === 0 || !inp.value) {
                errModal.classList.add('activeErrorModal')
                inp.value == ''
            } else {
                // chi ashxatum
                errModal.classList.remove('activeErrorModal')
            }
        })
    })

    document.querySelector('.my-close-error').addEventListener('click', (e) => {
        errModal.classList.remove('activeErrorModal')

    })
}


// ==========================

