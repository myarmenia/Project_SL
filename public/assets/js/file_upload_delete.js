


function drowNewFileTeg(tegTxt,$id) {
  const oneTeg = document.createElement('div')
  const txt = document.createElement('span')
  txt.textContent = tegTxt + '...'
  oneTeg.append(txt)
  const inp = document.createElement('textarea')
  inp.classList.add('video_teg_text_area')
  inp.classList.add('save_textarea_data')
  inp.setAttribute('name','file_comment')
  oneTeg.append(inp)
  const xMark = document.createElement('span')
  xMark.textContent = 'X'
  xMark.classList.add('xMark')
  xMark.classList.add('delete-items-from-db')
  xMark.setAttribute('data-delete-id',$id)
  xMark.setAttribute('data-table','file')
  xMark.setAttribute('data-model-name','Bibliography')
  oneTeg.append(xMark)
  oneTeg.classList.add('Myteg')
  oneTeg.classList.add('video-teg-class')
  oneTeg.classList.add('teg-text')

  return oneTeg
}

  const teg_text = document.querySelectorAll('.files .teg-text') 

  teg_text.forEach(el => {
      const tegTxt = el.innerText.split('').slice(0,15).join('')
      el.innerText = tegTxt + '...'
  })
 

  const file_id_word_input = document.getElementById('file_id_word')

  const newfile = document.querySelector('.newfile')
  file_id_word_input?.addEventListener('change', (e) => {
    let formData = new FormData();
    const sizeInBytes = file_id_word_input.files[0].size
    const sizeInKilobytes = sizeInBytes / 1024;
    const sizeInMegabytes = sizeInBytes / (1024 * 1024);



    if (file_id_word_input.files[0].type === "video/*" ||

      file_id_word_input.files[0].type === "video/x-m4v" ||
      file_id_word_input.files[0].type === "video/mp4" ||
      file_id_word_input.files[0].type === "video/mkv") {

      document.querySelector('.my-formCheck-class i').classList.add('change-video-style')
      const hiddenInp = document.getElementById('hiddenInp')
      hiddenInp.value = true
      formData.append("value", file_id_word_input.files[0]);
      console.log(file_id_word_input.files[0]);
    }
    console.dir(file_id_word_input.files[0]);


    const file_name_split = file_id_word_input.files[0].name.split('').slice(0, 10).join('')
    const fileName = file_name_split + sizeInBytes

    let newFileTeg = []
    let newInfo = {}
    const test = []

    formData.append('fieldName', 'file')

    if (sizeInBytes > 1024 && sizeInBytes < (1024 * 1024) && fileName) {
      const fileName = file_name_split + sizeInKilobytes.toFixed() + 'KB'
    //   newfile.append(drowNewFileTeg(fileName))
      formData.append("value", file_id_word_input.files[0]);


    }
    else if (sizeInBytes > (1024 * 1024) && fileName) {
      console.log(2);
      const fileName = file_name_split + sizeInMegabytes.toFixed() + 'MB'
    //   newfile.append(drowNewFileTeg(fileName))

      formData.append("value", file_id_word_input.files[0]);
    }

    else if (fileName && sizeInBytes < 1024) {

      const fileName = file_name_split + sizeInBytes.toFixed() + 'B'
    //   newfile.append(drowNewFileTeg(fileName))

      formData.append("value", file_id_word_input.files[0]);

    }

    const requestOption = {
      method: 'POST',
      body: formData

    }

    fetch(file_updated_route, requestOption)

      .then(async res => {
        if (!res) {
          console.log('error');
        }
        else {
          const data = await res.json()
          console.log(fileName,'5555');
          console.log(data.message);


          newfile.appendChild(drowNewFileTeg(fileName,data.message))
          let saveTextareaData = document.querySelectorAll('.save_textarea_data')
          saveTextareaData.forEach(textarea => {
            textarea.addEventListener('blur', onBlur)
            textarea.addEventListener('keyup', onKeypress)

        })
          DeleteFile()
        //   location.reload();
        //   onBlur(newfile)

        }
      })
  })

  DeleteFile()
  function DeleteFile() {
    const all_files=document.querySelectorAll('.delete-items-from-db')
    all_files.forEach(tag =>{
        tag.addEventListener('click', deleted_items_fn)
    })
}



//   =======================file delete section
// const deleted_items=document.querySelectorAll('.delete-items-from-db')
// deleted_items.forEach(el =>{
//     el.addEventListener('click', deleted_items_fn)
// })
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
               document.querySelector('.bi-check2').classList.remove("change-video-style");
            })


}



