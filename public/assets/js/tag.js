const tegsDiv = document.querySelector('.tegs-div')

function drowTeg(tag_modelName, tag_id, tag_name,) {

  const oneTeg = document.createElement('div')
  const txt = document.createElement('span')
  txt.textContent = tag_name
  oneTeg.append(txt)
  const xMark = document.createElement('span')
  xMark.classList.add('delete-from-db')
  xMark.setAttribute('data-delete-id',tag_id)
  xMark.setAttribute('data-modelname',tag_modelName)
  xMark.textContent = 'X'
  oneTeg.append(xMark)
  oneTeg.classList.add('Myteg')
  return oneTeg
}




const teg_items = document.querySelectorAll('.teg_class')
let current_tags = []
teg_items.forEach(el=>{
    el.addEventListener('blur', (e) =>{
      const tag_modelName = el.getAttribute('data-modelname')
      const tag_id = el.getAttribute('data-modelid')

      const tegValue = el.value
      let tag_name
        if(!current_tags.filter((c_tag) => c_tag == el.value ).length > 0 && el.value != '') {
          tag_name = el.value

          current_tags.push(el.value)


          tegsDiv.append(drowTeg(tag_modelName,tag_id,tag_name,))
          el.value = ''
        }
})

})


// ===========tag delete query===============================================================================

const tegX = document.querySelectorAll('.Myteg span:nth-of-type(2)')

tegX.forEach(x =>{
//   x.addEventListener('click', (e)=>{
//     alert()
//     console.log(x+'+++++++++++');
//    x.parentElement.remove()

//   })

})
// ==========================

const all_tags=document.querySelectorAll('.delete-from-db')
all_tags.forEach(tag =>{
    tag.addEventListener('click', deleted_tags)
})
function deleted_tags(){
 let tags_parameter_id = document.getElementById('tags_deleted_route')
    const deleted_url =tags_parameter_id.value
        const id = this.getAttribute('data-delete-id')
        const pivot_table_name = tags_parameter_id.getAttribute('data-pivot-table')
        const model_name = tags_parameter_id.getAttribute('data-model-name')
        const model_id = tags_parameter_id.getAttribute('data-model-id')
        console.log(model_id);

        csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch(deleted_url, {
                method: 'post',
                headers: {'Content-Type':'application/json','X-CSRF-TOKEN':csrf},
                body: JSON.stringify({id, pivot_table_name, model_name, model_id}),
            }).then(async response => {
                this.parentElement.remove();
                
            })


}

// document.querySelectorAll('.delete-from-db').forEach((el) => {
    // let tags_parameter_id = document.getElementById('tags_deleted_route')
    // el.addEventListener('click', () => {
    //     const deleted_url =tags_parameter_id.value
    //     const id = el.getAttribute('data-delete-id')
    //     const pivot_table_name = tags_parameter_id.getAttribute('data-pivot-table')
    //     const model_name = tags_parameter_id.getAttribute('data-model-name')
    //     const model_id = el.getAttribute('data-model-id')

    //     csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    //         fetch(deleted_url, {
    //             method: 'post',
    //             headers: {'Content-Type':'application/json','X-CSRF-TOKEN':csrf},
    //             body: JSON.stringify({id, pivot_table_name, model_name, model_id}),
    //         }).then(async response => {
    //             console.log(el);
    //             // el.parent.remove();
    //         })

    // })
// })
