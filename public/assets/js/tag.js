function drowTeg(parent_model_id,pivot_table_name,data,field_name,data_relation = 'belongs_to_many',edit = false) {
    return  `
        <div class="Myteg">
            <span class=""><a href="#">${data[field_name]}</a></span>
           ${edit ?  `<span class="edit-pen"><a href="#"><i class="bi bi-pen"></i></a></span>` : ''}
            <span
                 class="delete-from-db check_tag xMark"
                 data-value="${data[field_name]}"
                 data-delete-id="${data.id}"
                 data-table="knows_languages"
                 data-model-id="${parent_model_id}"
                 data-relation-type=${data_relation}
                 data-pivot-table="${pivot_table_name}">
              X
              </span>
        </div>`;
}

// on blur function  creating tags
const teg_items = document.querySelectorAll('.teg_class')

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
    const id = this.getAttribute('data-delete-id')
    const pivot_table_name = this.getAttribute('data-pivot-table')
    const model_id = this.getAttribute('data-model-id')
    const relation_type = this.getAttribute('data-relation-type')

    csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    // calling delete_item route from edit blade script

    const data= {id, pivot_table_name, model_id}
    if (relation_type) data.relation = relation_type
    console.log(relation_type);

    fetch(delete_item, {
        method: 'post',
        headers: {'Content-Type':'application/json','X-CSRF-TOKEN':csrf},
        body: JSON.stringify(data),
    }).then(async res => {
        const data = await res.json()
        if(data.result=='deleted'){
            this.parentElement.remove();
            if( ['lastName1','firstName1','middleName1'].includes(pivot_table_name) ){
                getFullName()
            }
        }

        let oneTegId =  current_tags.find(el => el === id)
        current_tags = current_tags.filter(el => el !== oneTegId)
    })
        .catch(async err =>{
            console.log(err);
        })
}


