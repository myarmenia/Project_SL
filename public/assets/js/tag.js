const teg_items = document.querySelectorAll('.teg_class')
teg_items.forEach(el=>{
    el.addEventListener('blur', (e) =>{
      const tag_modelName = el.getAttribute('data-modelname')
      const tag_id = el.getAttribute('data-modelid')
      const tag_name = el.value;
        tegsDiv.append(drowTeg(tag_modelName,tag_id,tag_name,))
        el.value = ''


})

})
