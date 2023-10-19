


// const tegsDiv = document.querySelector('.tegs-div')

function drowTeg(tag_modelName,tag_id,tag_name, parent_modal_name, parent_model_id,pivot_table_name) {

  const oneTeg = document.createElement('div')
  const txt = document.createElement('span')
  txt.textContent = tag_name
  oneTeg.append(txt)
  const xMark = document.createElement('span')
  xMark.classList.add('delete-from-db')
  xMark.setAttribute('data-delete-id',tag_id)
  xMark.setAttribute('data-model-id',parent_model_id)
  xMark.setAttribute('data-parent-modal-name',parent_modal_name)
  xMark.setAttribute('data-pivot-table',pivot_table_name)
  xMark.setAttribute('data-modelname',tag_modelName)
  xMark.textContent = 'X'
  oneTeg.append(xMark)
  oneTeg.classList.add('Myteg')
  return oneTeg
}



// on blur function  creating tags
// const teg_items = document.querySelectorAll('.teg_class')
// let current_tags = []

// const check=document.querySelectorAll('.check_tag')
// check.forEach(tag_el=>{
//     current_tags.push(tag_el.getAttribute('data-delete-id'))

// })

// teg_items.forEach(el=>{
//     el.addEventListener('blur', (e) =>{
// console.log(2222);
//         console.log(el)


//       const parent_modal_name=el.getAttribute('data-parent-model-name')
//     //   console.log('parent',parent_modal_name);
//       const pivot_table_name=el.getAttribute('data-pivot-table')
   
//     //   console.log(pivot_table_name);
//       const tag_modelName = el.getAttribute('data-modelname')
//     //   console.log(tag_modelName);
//       const parent_model_id = el.getAttribute('data-parent-model-id')
//       const tag_id = el.getAttribute('data-modelid')
//       let tag_name
//         if(!current_tags.filter((c_tag) => c_tag === el.getAttribute('data-modelid') ).length > 0 && el.value !=='' && el.value !==' ') {
//           tag_name = el.value

//           current_tags.push(el.getAttribute('data-modelid') )

//           tegsDiv.append(drowTeg(tag_modelName,tag_id,tag_name, parent_modal_name, parent_model_id,pivot_table_name))
//           el.value = ''
//         }
//         else{
//             el.value = ''
//         }
//         // calling delete deleted_tags() function for deleting after appending
//         DelItem()
//     })

// })


// ===========tag delete query===============================================================================

function DelItem() {
        const all_tags=document.querySelectorAll('.delete-from-db')
        all_tags.forEach(tag =>{
        tag.addEventListener('click', deleted_tags)
    })
}
// after updating call delete tags function
DelItem()

function deleted_tags(){
    // console.log(852);

        const id = this.getAttribute('data-delete-id')
        const pivot_table_name = this.getAttribute('data-pivot-table')
        const model_name = this.getAttribute('data-parent-modal-name')
        const model_id = this.getAttribute('data-model-id')

        csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        // calling delete_item route from edit blade script
            fetch(delete_item, {
                method: 'post',
                headers: {'Content-Type':'application/json','X-CSRF-TOKEN':csrf},
                body: JSON.stringify({id, pivot_table_name, model_name, model_id}),
            }).then(async res => {
                const data = await res.json()
                if(data.result=='deleted'){
                    this.parentElement.remove();
                }



               let oneTegId =  current_tags.find(el => el === id)

               let temp = current_tags.filter(el => el !== oneTegId)
                current_tags = temp
            })
            .catch(async err =>{
                console.log(err);
            })




}



