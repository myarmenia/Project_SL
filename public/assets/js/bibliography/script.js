const tegsArr = [];
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

//   function fetchInfo(url) {

//     const addNewInfoBtn = document.getElementById('addNewInfoBtn')

//     const addNewInfoInp = document.getElementById('addNewInfoInp')


//     addNewInfoBtn.addEventListener('submit', (e) =>{
//       e.preventDefault()
//       const newBody = {
//       name: addNewInfoInp.value
//       }

//       const requestOption = {
//       method: 'POST',
//       headers: {'Content-Type': 'application/json'},
//       body: JSON.stringify(newBody)
//       }


//                   fetch(url, requestOption)
//                   .then( async res => {
//                     if(!res){
//                       console.log('error');
//                     }
//                     else{
//                       const {data} = await res.json()

//                       data.forEach(el => drowTr(el))

//                     }
//                   })

//   })
//   }

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
                    // const section_id = data.section_id

                        // every time on open modal we clean input value
                    document.getElementById('table_id').innerHTML=''
                     // getting object value and in map creating tr
                    var objMap = new Map(Object.entries(result_object));
                    objMap.forEach((item) => {
                        // console.log(item.id)
                        document.getElementById('table_id').append(drowTr(item.name, item.id, model_name))
                    })
                        // calling  append_data function and transfer this  which is plus button
                    append_data(this)

                }
            })

        // =============== im grac mas end =================


        let url = this.getAttribute('data-url')

        // fetchInfo(url)
        fetchInfoInputEvent(this)
    }
// separate function for appendin  object
    function append_data(obj){
// console.log(obj)
        document.querySelectorAll('.addInputTxt').forEach((el)=>{

            el.addEventListener('click', (e)=>{
                console.log(el.closest('tr'))

                const parent = obj.closest('.form-floating')
                const text_content = el.closest('tr').querySelector('.inputName').textContent
                const model_id = el.closest('tr').querySelector('.modelId').textContent

                parent.querySelector('input').value = text_content
                parent.querySelector('input').setAttribute('data-modelid',model_id)


            })

        })

    }




    const tegsDiv = document.querySelector('.tegs-div')
// console.log(tegsDiv);
    function drowTeg(tegTxt) {

      const oneTeg = document.createElement('div')
      const txt = document.createElement('span')
      const link = document.createElement('a')
      link.innerText = tegTxt
      txt.append(link)
      oneTeg.append(txt)
      const xMark = document.createElement('span')
      xMark.textContent = 'X'
      oneTeg.append(xMark)
      oneTeg.classList.add('Myteg')
      return oneTeg
    }



    const item4 = document.getElementById('item4')

    item4.addEventListener('blur', (e) =>{
            tegsDiv.append(drowTeg(document.getElementById('item4').value))
            tegsArr.push(document.getElementById('item4').value)
            console.log(tegsArr)
            document.getElementById('item4').value = ''


    })



    const search_datalist = document.querySelectorAll('.input_datalists');
    const fetch_input_title = document.querySelectorAll('.fetch_input_title')

    fetch_input_title.forEach((el) => {
      let datalist = el.list
      el.addEventListener('input', () => {
        fetchInputTitle(el.value, datalist)
      })
    })




//===============   fetch input end =======================

  fetch_input_title.forEach((el) => {
    let datalist = el.list
    el.addEventListener('click', () => {
      fetchInputTitle(el.value, datalist)
    })
  })


  function fetchInputTitle(input, datalist) {
// console.log(412)
    const newTitle = {
      name: input
      }


      const requestOption = {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify(newTitle)
      }


                  fetch(URL, requestOption)
                  .then( async res => {
                    if(!res){
                      console.log('error');
                    }
                    else{
                      const {data} = await res.json()
                      let dataLength = data.length

                      errorModal(dataLength)

                      data.forEach(el => {
                        datalist.innerHTML = ''
                        const option = document.createElement('option')
                        option.innerText = el.name
                        datalist.appendChild(option)
                      })
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

  function onBlur(){


    let newInfo = {}


    // tegs.forEach(teg =>{
    //   tegsArr.push(teg.innerText)
    // })
    // console.log(tegsArr);

    formControl.forEach(input => {
        if(input.value){
            if(input.hasAttribute('data-modelid')){
                const get_model_id=input.getAttribute('data-modelid')

                newInfo = {
                    ...newInfo,
                    [input.name]: get_model_id
                }
            }else{
                newInfo = {
                    ...newInfo,
                    [input.name]: input.value
                }


            }
        }
    })

        if(tegsArr.length > 0){

             newInfo = {
               ...newInfo,
               tegs: tegsArr.length-1
             }
        }
        console.log(newInfo);



       const requestOption = {
         method: 'POST',
         headers: {'Content-Type': 'application/json'},
         body: JSON.stringify(newInfo)
         }


                     fetch('bibliography-store', requestOption)
                     .then( async res => {
                       if(!res){
                         console.log('error');
                       }
                       else{
                         const {data} = await res.json()


                       }
                     })



  }

  // =========================================================================================

  const errModal = document.getElementById('errModal')


  function errorModal(dataLength) {
    document.querySelectorAll('.form-control').forEach(inp =>{
      inp.addEventListener('blur', (e)=>{
        if (dataLength === 0 && inp.id === 'item4' || inp.id === 'item3' || inp.id === 'item2' || inp.id === 'item1') {
          errModal.classList.add('activeErrorModal')
          inp.value = ''
        }
      })
    })
    
    document.querySelector('.my-close-error').addEventListener('click',(e)=>{
      errModal.classList.remove('activeErrorModal')

    })
  }


  // ==========================================================================================

  const tegX = document.querySelectorAll('.Myteg span:nth-of-type(2)')

  tegX.forEach(x =>{
    x.addEventListener('click', (e)=>{
     x.parentElement.remove()

    })
  })


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


    

// Чтение .docx файла
    // const mammoth = require('mammoth');
    // const fs = require('fs');
    // fs.readFile(sizeInBytes, 'binary', (err, data) => {
    //   if (err) {
    //     console.error('Error reading the .docx file:', err);
    //     return;
    //   }
    
    //   // Преобразование .docx файла в JSON
    //   mammoth.extractRawText({ buffer: Buffer.from(data, 'binary') })
    //     .then((result) => {
    //       const jsonContent = JSON.stringify({ content: result.value }, null, 2);
    
    //       // Выведем JSON строку с содержимым .docx файла
    //       console.log(jsonContent);
    //     })
    //     .catch((error) => {
    //       console.error('Error converting .docx to JSON:', error);
    //     });
    // });


    const fileName = file_id_word_input.files[0].name +  sizeInBytes 

    let newFileTeg = []

    const test = []

    if (sizeInBytes > 1024 && sizeInBytes < (1024 * 1024) && fileName) {
      const fileName = file_id_word_input.files[0].name +  sizeInKilobytes.toFixed() + 'KB'
      newfile.append(drowNewFileTeg(fileName))
      newFileTeg = [
        {
          files: file_id_word_input.files[0]
        }
      ]
      
    }
    else if( sizeInBytes > (1024 * 1024) && fileName){
      const fileName = file_id_word_input.files[0].name +  sizeInMegabytes.toFixed() + 'MB'
      newfile.append(drowNewFileTeg(fileName))
      newFileTeg = [
        {
          files: file_id_word_input.files[0]
        }
      ]
    }
    
    else if (fileName && sizeInBytes < 1024) {
      const fileName = file_id_word_input.files[0].name +  sizeInBytes.toFixed() + 'B'
      newfile.append(drowNewFileTeg(fileName))
      newFileTeg = [
        {
          files: file_id_word_input.files[0]
        }
      ]
    }
   
    const requestOption = {
      method: 'POST',
      headers: {'Content-Type': 'multipart/form-data'},
      body: JSON.stringify(newFileTeg)
      }


                  fetch('https://651be2c0194f77f2a5af056f.mockapi.io/test', requestOption)
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








