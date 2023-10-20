// const tegsDiv = document.querySelector('.tegs-div')

function drowTeg(tag_modelName,tag_id,tag_name, parent_modal_name, parent_model_id,pivot_table_name,data,field_name) {
    console.info(field_name)
    return  `
        <div class="Myteg">
            <span class="">${data[field_name]}</span>
            <span
                 class="delete-from-db check_tag"
                 data-delete-id="${data.id}"
                 data-table="knows_languages"
                 data-model-id="${parent_model_id}"
                 data-parent-modal-name="${parent_modal_name}"
                 data-pivot-table="${pivot_table_name}">
              X
              </span>
        </div>`;
}



// on blur function  creating tags
const teg_items = document.querySelectorAll('.teg_class')

// let current_tags = []

// const check=document.querySelectorAll('.check_tag')
// check.forEach(tag_el=>{
//     current_tags.push(tag_el.getAttribute('data-delete-id'))

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


