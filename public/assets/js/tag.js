const tegsDiv = document.querySelector('.tegs-div')

function drowTeg(tag_modelName, tag_id, tag_name,) {

  const oneTeg = document.createElement('div')
  const txt = document.createElement('span')
  txt.textContent = tag_name
  oneTeg.append(txt)
  const xMark = document.createElement('span')
  xMark.setAttribute('data-id',tag_id)
  xMark.setAttribute('data-modelname',tag_modelName)
  xMark.textContent = 'X'
  oneTeg.append(xMark)
  oneTeg.classList.add('Myteg')
  return oneTeg
}




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
