function drowTeg(parent_model_id,pivot_table_name,data,field_name,data_relation = 'belongs_to_many', edit = false, more_data = false) {

    let revfield_name
    let editTegs;

    if (field_name === "date") {
        alert()
        let fieldName = data[field_name]
        revfield_name = fieldName.split("-").reverse().join('-')
    }
    else{
        revfield_name = data[field_name]
    }

    if (edit){
        if (more_data){
            editTegs = `
            <span class="edit-pen">
                <button class="get-data border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#additional_information">
                    <i class="bi bi-pen"></i>
                </button>

            </span>`
        }else{
            editTegs = `<span class="edit-pen"><a href="#"><i class="bi bi-pen"></i></a></span>`
        }
    }

    return  `
        <div class="Myteg">
            <span class="date_text teg-text"><a href="#">${revfield_name}</a></span>
           ${editTegs ?? ''}
            <span
                 class="delete-from-db check_tag xMark"
                 data-value="${data[field_name]}"
                 data-delete-id="${data.id}"
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

    fetch(delete_item, {
        method: 'post',
        headers: {'Content-Type':'application/json','X-CSRF-TOKEN':csrf},
        body: JSON.stringify(data),
    }).then(async res => {
        const data = await res.json()
        if(data.result=='deleted'){
            this.parentElement.remove();
            console.log(pivot_table_name)
            if( ['last_name','first_name','middle_name'].includes(pivot_table_name) ){
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


