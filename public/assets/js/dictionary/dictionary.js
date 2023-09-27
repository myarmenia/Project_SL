const editBtn = document.querySelectorAll('.my-edit')
const myinp = document.querySelectorAll('td input')

editBtn.forEach(btn => {
  btn.addEventListener('click', (e) =>{
   btn.closest('tr').querySelector('input').classList.add('active-input')
   btn.parentElement.querySelectorAll('.my-btn-class').forEach(el =>{
    el.classList.add('active-btns')
   })
   btn.classList.add('btns-none')
   btn.closest('tr').querySelectorAll('.btn_close_modal').forEach(el =>{
    el.classList.add('btns-none')
   })
   btn.closest('tr').querySelector('.tdTxt input').value = btn.closest('tr').querySelector('.tdTxt span').textContent.trim()
   btn.closest('tr').querySelector('.tdTxt span').textContent = ''
  })
})



let f =null
const closeBtns = document.querySelectorAll('.my-close')

closeBtns.forEach(btn => {
    let d =  btn.closest('tr').querySelector('.tdTxt span').textContent
    
  btn.addEventListener('click', (e) =>{
    
    btn.parentElement.querySelectorAll('.my-btn-class').forEach(el =>{
      el.classList.remove('active-btns')
     })
     btn.closest('tr').querySelectorAll('.btn_close_modal').forEach(el =>{
      el.classList.remove('btns-none')
     })
     editBtn.forEach(el =>{
      el.classList.remove('btns-none')
     })
     btn.closest('tr').querySelector('input').classList.remove('active-input')

     if(f === null){
         btn.closest('tr').querySelector('.tdTxt span').textContent = d
        }
        else{
            btn.closest('tr').querySelector('.tdTxt span').textContent = f
        }
     
  })
})


const subBtns = document.querySelectorAll('.my-sub')




subBtns.forEach(btn => {
  btn.addEventListener('click',  (e) =>{
    f = btn.closest('tr').querySelector('input').value
    btn.closest('tr').querySelector('.tdTxt span').textContent = btn.closest('tr').querySelector('.tdTxt input').value
    btn.closest('tr').querySelector('input').classList.remove('active-input')
    editBtn.forEach(el =>{
      el.classList.remove('btns-none')
     })
     btn.closest('tr').querySelectorAll('.btn_close_modal').forEach(el =>{
      el.classList.remove('btns-none')
     })
     btn.parentElement.querySelectorAll('.my-btn-class').forEach(el =>{
      el.classList.remove('active-btns')
     })
     const tdEditUrl = document.getElementById('resizeMe').getAttribute('data-edit-url') + btn.closest('tr').querySelector('.trId').textContent
     const newTitle = {
      name:  btn.closest('tr').querySelector('.tdTxt input').value,
      // id:   btn.closest('tr').querySelector('.trId').textContent
     }
     
     const requestOption = {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify(newTitle)
      }
      
     
                  fetch(tdEditUrl, requestOption)
                  .then( async res => {
                    if(!res){
                      console.log('error');
                      
                    }
                    else{
                      const {data} = await res.json()
                    }
                  })

  })


})

// =========================================================================


const myFormAction = document.querySelector('.my-form-class')

const createUrl = document.getElementById('resizeMe').getAttribute('data-create-url')

const myOpModal = document.querySelector('.my-opModal')

myOpModal.addEventListener('click', (e)=>{
  myFormAction.action = createUrl
  
})





