const tegsDiv = document.querySelector('.tegs-div')

function drowTeg(tag_modelName, tag_id, tag_name,) {

  const oneTeg = document.createElement('div')
  const txt = document.createElement('span')
  txt.textContent = tag_name
  oneTeg.append(txt)
  const xMark = document.createElement('span')
  xMark.classList.add('delete-from-db')
  xMark.setAttribute('data-delete-id',tag_id)
  xMark.setAttribute('data-model-id',tag_id)


  xMark.setAttribute('data-modelname',tag_modelName)
  xMark.textContent = 'X'
  oneTeg.append(xMark)
  oneTeg.classList.add('Myteg')
  return oneTeg
}




const teg_items = document.querySelectorAll('.teg_class')
let current_tags = []

const check=document.querySelectorAll('.check_tag')
check.forEach(tag_el=>{
    current_tags.push(tag_el.getAttribute('data-delete-id'))
    
})

// console.log(current_tags);
teg_items.forEach(el=>{
    el.addEventListener('blur', (e) =>{

      const tag_modelName = el.getAttribute('data-modelname')
      const teg_model_id = el.getAttribute('data-model-id')

      const tag_id = el.getAttribute('data-modelid')
      

      let tag_name
        if(!current_tags.filter((c_tag) => c_tag === el.getAttribute('data-modelid') ).length > 0 && el.value !=='') {
          tag_name = el.value

          current_tags.push(el.getAttribute('data-modelid') )


          tegsDiv.append(drowTeg(tag_modelName,tag_id,tag_name,))
          el.value = ''
        }
        else{
            el.value = ''
        }
        DelItem()
})

})


// ===========tag delete query===============================================================================

function DelItem() {
        const all_tags=document.querySelectorAll('.delete-from-db')
        all_tags.forEach(tag =>{
        tag.addEventListener('click', deleted_tags)
    })
}

DelItem()

function deleted_tags(){

 let tags_parameter_id = document.getElementById('tags_deleted_route')
    const deleted_url = delete_item
        const id = this.getAttribute('data-delete-id')
        const pivot_table_name = this.getAttribute('data-pivot-table')
        const model_name = this.getAttribute('data-model-name')
        const model_id = this.getAttribute('data-model-id')

        csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch(delete_item, {
                method: 'post',
                headers: {'Content-Type':'application/json','X-CSRF-TOKEN':csrf},
                body: JSON.stringify({id, pivot_table_name, model_name, model_id}),
            }).then(async response => {
                this.parentElement.remove();
                
               let oneTegId =  current_tags.find(el => el === id)
                
               let temp = current_tags.filter(el => el !== oneTegId)
                current_tags = temp
            })
            .then( async res => {
                if(!res){
                  console.log('error');
                }
                else{

                    const data = await res.json()
                    // this.parentElement.remove();
                    console.log(data);
                }
              })


}


// ====
const deleted_items=document.querySelectorAll('.delete-items-from-db')
deleted_items.forEach(el =>{
    el.addEventListener('click', deleted_items_fn)
})
function deleted_items_fn(){
 let deleted_route_params = document.getElementById('deleted_route')
    const deleted_url = deleted_route_params.value
        const id = this.getAttribute('data-delete-id')
        const pivot_table_name = deleted_route_params.getAttribute('data-pivot-table')
        const model_name = this.getAttribute('data-model-name')
        const model_id = this.getAttribute('data-model-id')
        console.log(model_id);

        csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch(deleted_url, {
                method: 'post',
                headers: {'Content-Type':'application/json','X-CSRF-TOKEN':csrf},
                body: JSON.stringify({id, pivot_table_name, model_name, model_id}),
            }).then(async response => {
                this.parentElement.remove();
               console.log(response);
            })


}
