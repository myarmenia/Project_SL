function drowTr(newTr,key,model_name) {

      const tr = document.createElement('tr')

      const td1 = document.createElement('td')
      td1.innerText = key
      td1.classList.add('modelId')
      tr.append(td1)

      const td2 = document.createElement('td')

      td2.innerText = newTr
      td2.setAttribute('data-model',model_name)


      td2.classList.add('inputName')
      tr.append(td2)
      const td3 = document.createElement('td')
      const btn = document.createElement('button')
      btn.textContent = 'Ավելացնել'
      btn.classList.add('addInputTxt')
      btn.classList.add('btn-primary')
      btn.classList.add('btn')
      btn.setAttribute('data-id',1)
      btn.setAttribute('data-bs-dismiss', 'modal')
      btn.setAttribute('aria-label', 'Close')
      td3.append(btn)
      tr.append(td3)

      return tr
    }


    function fetchInfo(obj) {
        console.log(456);

      const addNewInfoBtn_modal = document.getElementById('addNewInfoBtn')

      const addNewInfoInp = document.getElementById('addNewInfoInp')
      const table_name=obj.getAttribute('data-id');


      addNewInfoBtn_modal.addEventListener('submit', (e) =>{
        e.preventDefault()
        const newBody = {
                value: addNewInfoInp.value,
                fieldName: addNewInfoInp.name,
                table_name:table_name,
        }
        console.log(newBody)
        const requestOption = {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(newBody)
        }


                    fetch('model-store', requestOption)
                    .then( async res => {
                      if(!res){
                        console.log('error');
                      }
                      else{
                        const data = await res.json()
                        const result_object = data.result
                        console.log(result_object)
                        const model_name = data.model_name
                        document.getElementById('table_id').innerHTML=''
                        var objMap = new Map(Object.entries(result_object));
                        objMap.forEach((item,key) => {


                            document.getElementById('table_id').append(drowTr(item.name,key,model_name))
                        })

                        append_data(obj)
                        document.getElementById('addNewInfoInp').value=''

                      }
                    })

    })
    }

  // ================oninput=========================================================================================
      // transfer plus button  as obj

  function fetchInfoInputEvent(obj) {

          const url=obj.getAttribute('data-url')
          // console.log(url);

      const addNewInfoBtn = document.getElementById('addNewInfoBtn')

      const addNewInfoInp = document.getElementById('addNewInfoInp')


      addNewInfoBtn.addEventListener('input', (e) =>{
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
          .then( async res => {

              if(!res){
                  console.log('error');
              }
              else{

                  const data = await res.json()
                  const result_object = data.result
                  const model_name = data.model_name
                  document.getElementById('table_id').innerHTML=''
                  var objMap = new Map(Object.entries(result_object));
                  objMap.forEach((item,key) => {

                      document.getElementById('table_id').append(drowTr(item,key,model_name))
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

      function openModal(){
          // ============== im grac mas start ===============
          document.getElementById('addNewInfoInp').value=''
          const get_url = this.getAttribute('data-section')
          const  fieldname_db = this.getAttribute('data-fieldname')


          const get_table_name =this.getAttribute('data-id')
          const newBody = {
              table_name: get_table_name
              }
              console.log(get_url)

              const requestOption = {
                  method: 'POST',
                  headers: {'Content-Type': 'application/json'},
                  body: JSON.stringify(newBody)
              }
              fetch(get_url, requestOption)
              .then( async res => {

                  if(!res){
                      console.log('error');
                  }
                  else{

                      const data = await res.json()
                      const result_object = data.result
                      const model_name = data.model_name

                          // every time on open modal we clean input value
                      document.getElementById('table_id').innerHTML=''
                       // getting object value and in map creating tr
                      var objMap = new Map(Object.entries(result_object));
                      objMap.forEach((item) => {
                        // console.log(item);

                          // console.log(item.id)
                          document.getElementById('table_id').append(drowTr(item[fieldname_db], item.id, model_name))
                      })
                          // calling  append_data function and transfer this  which is plus button
                      append_data(this)

                  }
              })

          // =============== im grac mas end =================
            // in modal  make filter
          fetchInfoInputEvent(this)
          fetchInfo(this)
      }
  // separate function for appendin  object
      function append_data(obj){
  // console.log(obj)
          document.querySelectorAll('.addInputTxt').forEach((el)=>{

              el.addEventListener('click', (e)=>{
                  // console.log(el.closest('tr').querySelector('.inputName').getAttribute('data-model'))

                  const parent = obj.closest('.form-floating')
                  const text_content = el.closest('tr').querySelector('.inputName').textContent
                  const model_id = el.closest('tr').querySelector('.modelId').textContent
                  const model_name=el.closest('tr').querySelector('.inputName').getAttribute('data-model')

                  parent.querySelector('input').value = text_content
                  parent.querySelector('input').focus()
                  parent.querySelector('input').setAttribute('data-modelid',model_id)
                  parent.querySelector('input').setAttribute('data-modelname',model_name)


              })

          })

      }





  // tag script

  // tag script


  // search in plus section
      const search_datalist = document.querySelectorAll('.input_datalists');
      const fetch_input_title = document.querySelectorAll('.fetch_input_title')

      fetch_input_title.forEach((el) => {

        el.addEventListener('input', () => {

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
  inp.addEventListener('change', (e) =>{
    let thisVal = inp.value
    let datalist_id = inp.getAttribute('list')
    let dataId = inp.closest('.col').querySelector('.my-plus-class').getAttribute('data-id')
    console.log(dataId);
    var opts = document.getElementById(''+datalist_id).childNodes

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

      const url=el.closest('.form-floating').querySelector('.my-plus-class').getAttribute('data-url');
      const newTitle = {
        name: el.value
        }


        const requestOption = {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(newTitle)
        }


                    fetch(url, requestOption)
                    .then( async res => {
                      if(!res.ok){
                        errorModal()
                        console.log('error');
                        el.value=''
                      }
                      else{
                        const data = await res.json()
                        const result=data.result

                        el.closest('.col').querySelector('datalist').innerHTML=''
                          const objMap = new Map(Object.entries(result));
                          objMap.forEach((item,key) => {

                             const option = document.createElement('option')
                              option.innerText = item
                              option.setAttribute('data-modelid',key)
                                el.closest('.col').querySelector('datalist').appendChild(option)

                          })

                      }

                    })


    }

    // ========================================================================================


    const formControl = document.querySelectorAll('.form-control')

    const tegs = document.querySelectorAll('.Myteg span:nth-of-type(1)')


    formControl.forEach(input => {

      input.addEventListener('blur', onBlur)
    })

    function onBlur(){

      let newInfo = {}

          if(this.value){
              if(this.hasAttribute('data-modelid')){
                  const get_model_id=this.getAttribute('data-modelid')


                  newInfo = {

                      value: get_model_id,
                      fieldName: this.name


                  }
            }else{
                console.log(4444444);
                  newInfo = {
                      value:this.value,
                      fieldName: this.name

                  }

              }
          }


        if(this.value){
            console.log(65566);

         const requestOption = {
           method: 'POST',
           headers: {'Content-Type': 'application/json'},
           body: JSON.stringify(newInfo)
           }


                       fetch('model-update/?id='+url_id+'&&table_name='+table_name, requestOption)
                       .then( async res => {
                         if(!res){
                           console.log('error');
                         }
                         else{
                           const data = await res.json()
                           const result= data.message
                           console.log(result)


                         }
                       })
        }
        fetchInputTitle(this)


    }

    // =========================================================================================

    function errorModal() {
        const errModal = document.getElementById('errModal')


        errModal.classList.add('activeErrorModal')

        document.querySelector('.my-close-error').addEventListener('click', (e) => {

          errModal.classList.remove('activeErrorModal')


        })
      }


    // ==========================
    // ======================================

  function drowNewFileTeg(tegTxt) {
    const oneTeg = document.createElement('div')
    const txt = document.createElement('span')
    txt.textContent = tegTxt
    oneTeg.append(txt)
    oneTeg.classList.add('Myteg')
    return oneTeg
  }

  const file_id_word_input = document.getElementById('file_id_word')

  const newfile = document.querySelector('.newfile')
  file_id_word_input.addEventListener('change', (e) =>{
    const sizeInBytes = file_id_word_input.files[0].size
    const sizeInKilobytes = sizeInBytes / 1024;

    const sizeInMegabytes = sizeInBytes / (1024 * 1024);

    if(file_id_word_input.files[0].type == "video/mp4" || "video/mov"){
        document.getElementById('checkAll').checked = true
    }



    const fileName = file_id_word_input.files[0].name +  sizeInBytes

    let newFileTeg = []
    let newInfo={}
    const test = []
    let formData = new FormData();
    formData.append('fieldName','file')
    // formData.append("value", file_id_word_input.files[0]);


    if (sizeInBytes > 1024 && sizeInBytes < (1024 * 1024) && fileName) {
    console.log(1);
      const fileName = file_id_word_input.files[0].name +  sizeInKilobytes.toFixed() + 'KB'
      newfile.append(drowNewFileTeg(fileName))
      formData.append("value", file_id_word_input.files[0]);
    //   newFileTeg = [
    //     {
    //       files: file_id_word_input.files[0]
    //     }

    //   ]

    }
    else if( sizeInBytes > (1024 * 1024) && fileName){
        console.log(2);
      const fileName = file_id_word_input.files[0].name +  sizeInMegabytes.toFixed() + 'MB'
      newfile.append(drowNewFileTeg(fileName))

        formData.append("value", file_id_word_input.files[0]);
    }

    else if (fileName && sizeInBytes < 1024) {
        console.log(3);
      const fileName = file_id_word_input.files[0].name +  sizeInBytes.toFixed() + 'B'
      newfile.append(drowNewFileTeg(fileName))

    formData.append("value", file_id_word_input.files[0]);

    }

    const requestOption = {
      method: 'POST',
    //   headers: {
        // 'Content-Type': 'multipart/form-data; boundary=—-WebKitFormBoundaryfgtsKTYLsT7PNUVD',
        // 'Content-Type': 'application/json',

        // 'Accept':'application/json',
        // 'X-CSRF-TOKEN':csrf
    //   },
    //   body:k
    //   body:JSON.stringify(newInfo)
      body:formData

      }





                  fetch('model-update/?id='+url_id+'&&table_name='+table_name, requestOption)
                  .then( async res => {
                    if(!res){
                      console.log('error');
                    }
                    else{
                      const data = await res.json()
                      console.log(data.name);
                    const div2 = document.createElement('div')
                    div2.innerText = data.name
                      document.getElementById('fileeHom').appendChild(drowTeg(div2.innerText))
                    }
                  })

})

// document.querySelectorAll('.delete-from-db').forEach((el) => {
//     el.addEventListener('click', () => {
//         const id = el.getAttribute('data-delete-id')
//         const table_name = el.getAttribute('data-table')
//         csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
//             fetch('/staff/delete-image', {
//                 method: 'post',
//                 headers: {'Content-Type':'application/json','X-CSRF-TOKEN':csrf},
//                 body: JSON.stringify({id, table_name}),
//             }).then(async response => {
//                 el.closest('.file-box').remove();
//             })

//     })
// })


