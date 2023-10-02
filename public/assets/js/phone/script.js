
function drowTr(newTr) {
    
    const tr = document.createElement('tr')
  
    const td1 = document.createElement('td')
    td1.textContent = newTr.id
    tr.append(td1)
    const td2 = document.createElement('td')
    td2.textContent = newTr.name
    td2.classList.add('inputName')
    tr.append(td2)
    const td3 = document.createElement('td')
    const btn = document.createElement('button')
    btn.textContent = 'Ավելացնել'
    btn.classList.add('addInputTxt')
    btn.classList.add('btn-primary')
    btn.classList.add('btn')
    btn.getAttribute('data-bs-dismiss', 'modal')
    btn.getAttribute('aria-label', 'Close')
    td3.append(btn)
    tr.append(td3)
  
    return tr
  }
  
  function fetchInfo(url) {
    const addNewInfoBtn = document.getElementById('addNewInfoBtn')
  
    const addNewInfoInp = document.getElementById('addNewInfoInp')
  
  
    addNewInfoBtn.addEventListener('submit', (e) =>{
      e.preventDefault()
      const newBody = {
      name: addNewInfoInp.value
      }
  
      const requestOption = {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify(newBody)
      }
      
     
                  // fetch(url, requestOption)
                  // .then( async res => {
                  //   if(!res){
                  //     console.log('error');
                  //   }
                  //   else{
                  //     const {data} = await res.json()
  
                  //     data.forEach(el => drowTr(el))
                      
                  //   }
                  // })
  
  })
  }
  
  // =========================================================================================================
  
  function fetchInfoInputEvent(url) {
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
                      const {data} = await res.json()
  
                      data.forEach(el => drowTr(el))
                      
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
  
      let parent = this.closest('.form-floating')    
      let input_id = parent.querySelector('.form-control').getAttribute('data-id')    
      let url = this.getAttribute('data-url')
         
      
      fetchInfo(url)
  
      fetchInfoInputEvent(url)
  
      addInputTxt.forEach(btn => {
        btn.dataset.id = input_id
        btn.addEventListener('click', (e)=>{
          if(input_id === btn.dataset.id){
            parent.querySelector('.form-control').value = btn.closest('tr').querySelector('.inputName').textContent
            if(parent.querySelector('.form-control').id === 'item4'){
              parent.querySelector('.form-control').value = btn.closest('tr').querySelector('.inputName').textContent
            }
          }
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

    
  
  
  // fetch input end
  
  // fetch_input_title.forEach((el) => {
  //   let datalist = el.list
  //   el.addEventListener('click', () => {
  //     fetchInputTitle(el.value, datalist)
  //   })
  // })
  
  
  function fetchInputTitle(input, datalist) {

    const newTitle = {
      name: input
      }


      const requestOption = {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify(newTitle)
      }
      
     
                  // fetch(URL, requestOption)
                  // .then( async res => {
                  //   if(!res){
                  //     console.log('error');
                  //   }
                  //   else{
                  //     const {data} = await res.json()
                  //     let dataLength = data.length
  
                  //     errorModal(dataLength)
  
                  //     data.forEach(el => {
                    // datalist.innerHTML = ''


                  //       const option = document.createElement('option')
                  //       option.innerText = el.name
                  //       datalist.appendChild(option)
                  //     })
                  //   }

                  // })

                 
  }
  
  // ========================================================================================
  
  
  const formControl = document.querySelectorAll('.form-control')
  
  const tegs = document.querySelectorAll('.Myteg span:nth-of-type(1)')
  
  formControl.forEach(input => {
  
    input.addEventListener('blur', onBlur)
  })
  
  function onBlur(){
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
         
        
                    //  fetch(URL, requestOption)
                    //  .then( async res => {
                    //    if(!res){
                    //      console.log('error');
                    //    }
                    //    else{
                    //      const {data} = await res.json()
                    //    }
                    //  })
  
   
      
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
  



// =============================================================================================

  let inputPhone = document.getElementById('inputPhone')
 


inputPhone.addEventListener('input', (e) =>{
  
  let arr = inputPhone.value.split('')

 for (let i = 0; i < arr.length; i++) {
  if (arr[i] != +arr[i] && arr[i] !== '(' && arr[i] !== ')') {
    arr[i] = ''
  }
  inputPhone.value = arr.join('')
 } 
 })