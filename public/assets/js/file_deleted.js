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
