// ============================================
// file generate fetch
// ============================================

async function getFileData(files) {

    const postUrl = generate_file;

    try {
        const response = await fetch(postUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(files),
        });
        if (!response.ok) {
            throw new Error("Network response was not ok");
        } else {
            let responce =  await response.json()

            if(Array.isArray(responce.message)){
                let result=responce.message
                result.forEach(el => {
                    console.log(el);
                    const downloadTag = `<a href="/${lang}/download?path=${el}" class='parag_file'>download</a>`;

                    console.log(downloadTag)
                        document.getElementById('downloaded_file').innerHTML+=downloadTag
                      


                })
                document.querySelectorAll('.parag_file')?.forEach(el =>{
                    console.log(444);
                    console.log(el);
                    el.click()
                })
                // console.log(document.querySelectorAll('.parag_file'));


            }
            if(responce.message=='response file not generated'){
                errorModal(response_file_not_generated)
            }


            let loader = document.body.querySelector('#loader-wrapper')
            loader?.remove()
            // if(responce.message=='file_has_been_gererated'){

            //     let downloadTeg="<a href=/"+lang+"/download?path="+result.message+" id='parag_file' >download</a>"
            //     document.getElementById('downloaded_file').innerHTML=downloadTeg
            //     document.getElementById('parag_file').click()
            //     errorModal(answer_message)
            // }else{
            //
            // }
            // clearCheckedInput()
        }
    } catch (error) {
        console.error("Error:", error);
    }
}

// ============================================
// file generate fetch end
// ============================================
// ============================================
// checket input js
// ============================================

// let all_checked_input = document.querySelector(".all-checked-input");
let checked_input = document.querySelectorAll(".checked-input");

// all_checked_input?.addEventListener("change", (e) => {
//     checked_input.forEach((el) => (el.checked = all_checked_input.checked));
// });

checked_input.forEach((el) => {
    el.addEventListener("change", () => {
        let bullTrue = 0;
        let bullFalse = 0;
        checked_input.forEach((el) => {
            if (el.checked) {
                bullTrue++;
            } else {
                bullFalse++;
            }
        });
        bullTrue === checked_input.length
            ? (all_checked_input.checked = true)
            : bullFalse === checked_input.length
            ? (all_checked_input.checked = false)
            : bullTrue !== checked_input.length
            ? (all_checked_input.checked = false)
            : "";
    });
});
// ============================================
//  checket input js end
// ============================================

// ============================================
// show file text js
// ============================================

let show_file_text = document.querySelectorAll(".show-file-text");
show_file_text.forEach((icon) =>
    icon.addEventListener("click", (e) => {
        let file_text = e.target.querySelector("p").innerHTML;
        let file_infon = e.target
            .closest("tr")
            .querySelector(".file_info").innerText;
        let show_file_modal = document.querySelector(".show-file-modal");
        let modal_title = show_file_modal.querySelector(".modal-title");
        let modal_body = show_file_modal.querySelector(".modal-body");
        modal_title.innerText = file_infon;
        modal_body.innerHTML = file_text;
    })
);

// ============================================
// show file text js end
// ============================================


// ============================================
// save files js
// ============================================

// ============================================
// search files js
// ============================================
let search_file_btn = document.querySelector(".search-file-btn");
let p = document.querySelector(".search-word");
search_file_btn.addEventListener("click", () => {
    showLoaderFIle ()
    let input = document.getElementById("search_input");
    p.innerText = input.value;
});
// ============================================
// search files js end
// ============================================

let save_file_btn = document.querySelector(".save-file-btn");

function saveFunction() {
    showLoaderFIle()
    let allCheckedInput = document.querySelectorAll(".checked-input");
    let idArr = [];
    allCheckedInput.forEach((el) => {
        if (el.checked) {
            idArr.push(el.getAttribute('data-id'));
        }
    });
    getFileData(idArr);
}

save_file_btn?.addEventListener("click", () => saveFunction());

// ============================================
// save files js end
// ============================================

// ============================================
// search-file-modal btn js
// ============================================
function clearCheckedInput (){
    let search_file_modal_btn = document.querySelector('.search-file-modal')
    search_file_modal_btn?.addEventListener('click' , () => {
        all_checked_input.checked = false
        checked_input.forEach(el => el.checked = false)
    })
}

// ============================================
// search-file-modal btn js end
// ============================================

function showLoaderFIle (){
    let loader_wrapper = document.createElement('div')
    loader_wrapper.id = "loader-wrapper"
    let loader = document.createElement('div')
    loader.id = "loader"
    loader_wrapper.appendChild(loader)
    document.body.appendChild(loader_wrapper)
}
// ============================================
// search-input-number js
// ============================================

    let search_input_num = document.querySelector('.search-input-num')
    let distance_fileSearch = document.querySelector('.distance_fileSearch')
    let search_input = document.getElementById("search_input");
    let search_inp_lable = document.querySelector('.search_inp_lable')
    
    if(search_input_num.value !== ''){
        distance_fileSearch.value = 1
        distance_fileSearch.setAttribute('disabled','disabled')
    }

    search_input_num.addEventListener('input', () => searchInpNumValidate (search_input_num))

    function searchInpNumValidate (search_input_num){

        let checked_input = document.querySelectorAll('.search-input')
        textInputValidate(search_input)

        if(isNaN(+search_input_num.value) || search_input_num.value === ''){
            search_input_num.value = ''
            checked_input.forEach(el =>  el.removeAttribute('disabled'))
            distance_fileSearch.removeAttribute('disabled')
            distance_fileSearch.selectedIndex = 0
        }else{
            checked_input.forEach(el =>  {
                el.checked = false
                el.setAttribute('disabled','disabled')
            })
            distance_fileSearch.value = 1
            distance_fileSearch.setAttribute('disabled','disabled')

        }

        if(search_input_num.value !== '' && +search_input_num.value !== 0){
                checked_input.forEach(el =>  {
                    el.checked = false
                    el.setAttribute('disabled','disabled')
                })
                distance_fileSearch.value = 1
                distance_fileSearch.setAttribute('disabled','disabled')

        }else{
            search_input_num.value = ''
            search_inp_lable.innerText = ''
            checked_input.forEach(el =>  el.removeAttribute('disabled'))
            distance_fileSearch.removeAttribute('disabled')
            distance_fileSearch.selectedIndex = 0
        }

    }

    



// ============================================
// search-input-number js  end
// ============================================

// ============================================
    // search select validate 
// ============================================
distance_fileSearch.addEventListener('change', () => fileSelectValidate(distance_fileSearch))

function fileSelectValidate (distance_fileSearch){
    let checked_input = document.querySelectorAll('.search-input')
    let revers_word = document.getElementById('revers_word')

    if(distance_fileSearch.value == 2){

        revers_word.checked = false
        revers_word.setAttribute('disabled','disabled')
        search_input_num.setAttribute('disabled','disabled')
        checked_input.forEach(el =>  {
            el.checked = false
            el.setAttribute('disabled','disabled')
        })

    }else{
        revers_word.removeAttribute('disabled')
        search_input_num.removeAttribute('disabled')
        checked_input.forEach(el =>  {
            el.removeAttribute('disabled')
        })

    }
}
// ============================================
    // search select validate end
// ============================================
// ============================================
    // search input text validate 
// ============================================
 function textInputValidate(search_input){
    let result = search_input.value.replace(/^\s+|\s+$/g, '')
    let inp_value = result.split(' ')
    if(inp_value.length === 2  ||  search_input_num.value === ''){
        search_inp_lable.innerText = ''
        search_file_btn.removeAttribute('disabled')

    }else{

        search_file_btn.setAttribute('disabled','disabled')
        search_inp_lable.innerText = `${search_error_mesage}`

    }
 }
 search_input.addEventListener('input', () => textInputValidate(search_input))
// ============================================
    // search input text validate end
// ============================================

// ============================================
    // chechked input validate 
// ============================================
let chechked_inputs = document.querySelectorAll('.search-input')
let synonyms_input = chechked_inputs[0]
let car_input = chechked_inputs[1]

car_input.addEventListener('change', () => {
    if(car_input.checked){
        synonyms_input.checked = !car_input.checked
        distance_fileSearch.value = 1
        distance_fileSearch.setAttribute('disabled','disabled')
        revers_word.checked = false
        revers_word.setAttribute('disabled','disabled')
        search_input_num.setAttribute('disabled','disabled')
    }else{
        synonyms_input.checked = synonyms_input.checked 
        distance_fileSearch.removeAttribute('disabled')
        distance_fileSearch.selectedIndex = 0
        revers_word.removeAttribute('disabled')
        search_input_num.removeAttribute('disabled')
    }
})

synonyms_input.addEventListener('change', () => {
    if(synonyms_input.checked){
        car_input.checked = !synonyms_input.checked
        distance_fileSearch.value = 1
        distance_fileSearch.setAttribute('disabled','disabled')
        revers_word.checked = false
        revers_word.setAttribute('disabled','disabled')
        search_input_num.setAttribute('disabled','disabled')
    }else{
        car_input.checked =  car_input.checked 
        distance_fileSearch.removeAttribute('disabled')
        distance_fileSearch.selectedIndex = 0
        revers_word.removeAttribute('disabled')
        search_input_num.removeAttribute('disabled')
    }
})
// ============================================
    // chechked input validate end
// ============================================




