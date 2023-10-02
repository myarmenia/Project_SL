
  function drowTr(newTr,key) {

    const tr = document.createElement('tr')

    const td1 = document.createElement('td')
    td1.innerText = key
    tr.append(td1)
    const td2 = document.createElement('td')
    td2.innerText = newTr
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
                // console.log(data)

                const result_object = data.result
                // console.log(k)

                //    k․forEach(el => drowTr(el))
                //         drowTr(k)
                document.getElementById('table_id').innerHTML=''
                var objMap = new Map(Object.entries(result_object));
                objMap.forEach((item,key) => {
                    document.getElementById('table_id').append(drowTr(item,key))
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
        const get_url=this.getAttribute('data-section')
        const get_section_id=this.getAttribute('data-id')
        const newBody = {
            section_id: get_section_id
            }

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
                    let result_object=data.result
                    // data.forEach(el => drowTr(el))
                    //     drowTr(k)
                        // every time on open modal we clean input value
                    document.getElementById('table_id').innerHTML=''
                     // getting object value and in map creating tr
                    var objMap = new Map(Object.entries(result_object));
                    objMap.forEach((item) => {
                        // console.log(item.id)
                        document.getElementById('table_id').append(drowTr(item.name,item.id))
                    })
                        // calling  append_data function and transfer this  which is plus button
                    append_data(this)

                }
            })





        // =============== im grac mas end =================

        // let parent = this.closest('.form-floating')
        // let input_id = parent.querySelector('.form-control').getAttribute('data-id')
        let url = this.getAttribute('data-url')

        // fetchInfo(url)
        fetchInfoInputEvent(this)
    }
// separate function for appendin  object
    function append_data(obj){


        document.querySelectorAll('.addInputTxt').forEach((el)=>{

            el.addEventListener('click', (e)=>{

                const parent = obj.closest('.form-floating')
                const text_content = el.closest('tr').querySelector('.inputName').textContent
                parent.querySelector('input').value = text_content

            })

        })

    }




    const tegsDiv = document.querySelector('tegs-div')

    function drowTeg(tegTxt) {
      const oneTeg = document.createElement('div')
      const txt = document.createElement('span')
      txt.textContent = tegTxt
      oneTeg.append(txt)
      const xMark = document.createElement('span')
      xMark.textContent = 'X'
      oneTeg.append(xMark)
      oneTeg.classList.add('Myteg')
      return oneTeg
    }

    document.body.addEventListener('click',(e)=>{
      if(e.target.id !== 'item4' && document.getElementById('item4').value){
        tegsDiv.append(drowTeg(document.getElementById('item4').value))
      }

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

  formControl.forEach(input => {

    input.addEventListener('blur', onBlur)
  })

  function onBlur(){
    console.log('blute')
    const tegsArr = []
    let newInfo = {}


    tegs.forEach(teg =>{
      tegsArr.push(teg.innerText)
    })

    formControl.forEach(input => {


         if(input.value){
           newInfo = {
            ...newInfo,
             [input.name]: input.value
           }
         }
        })
         if(tegsArr.length > 0){
             newInfo = {
               ...newInfo,
               tegs: [...tegsArr]
             }

    }


       const requestOption = {
         method: 'POST',
         headers: {'Content-Type': 'application/json'},
         body: JSON.stringify(newInfo)
         }


                     fetch(URL, requestOption)
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
