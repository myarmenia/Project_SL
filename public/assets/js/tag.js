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
