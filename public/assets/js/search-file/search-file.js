// const serachButton = document.getElementById("serach_button");
// let cardBody = document.querySelector(".card-body");

// serachButton.addEventListener("click", () => {
//   let activTable = document.querySelector(".table");
//   if (!activTable) {
    
//     let searchButtonInp = document.getElementById("search_text");
//     let searchInput = document.getElementById("search_input");

//     let searchTextDiv = document.createElement("div");
//     searchTextDiv.textContent = searchInput.value;
//     searchTextDiv.style = `
//       border: 1px solid;
//       width: fit-content;
//       padding: 6px;
//       border-radius: 10px;
//   `;
//     // searchButtonInp.insertAdjacentElement("afterend", searchTextDiv);
    
//     ///////////table create ////////////////
//     let div = document.createElement("div");
//     div.style = `
//   overflow: auto;
//   padding-bottom: 20px;
//   `;
//     let table = document.createElement("table");
//     let tbody = document.createElement("tbody");
//     let thead = document.createElement("thead");

//     table.className = "person_table table";
//     table.style.marginTop = "30px";
//     let trTh = document.createElement("tr");

//     trTh.innerHTML = `
//     <th class="input-th change-th change-all-input" style="text-align: center"><input type="checkbox" class="form-check-input"/></th>
//       <th>id</th>
//       <th>${association}</th>
//       <th>${keyword}</th>
//       <th>${fileName}</th>
//       <th>${contactPerson}</th>
//   `;

//     thead.appendChild(trTh);
//     table.appendChild(thead);

//     let trTd = document.createElement("tr");
//     trTd.innerHTML = `
//     <td class="input-td change-td" style="text-align: center"><input type="checkbox" class="form-check-input"/></td>
//     <td>tiv</td>
//     <td class="input-td change-td" >${searchInput.value}</td>
//     <td class="input-td change-td" >cccc</td>
//     <td class ='change-td-btn'></td>
//     <td></td>
    
// `;
//     tbody.appendChild(trTd);
//     table.appendChild(tbody);
//     div.appendChild(table);
//     searchInput.value =""
//     let button = document.createElement("button");
//     let button_block = document.createElement('div')
//     button_block.style = `
//     display: flex;
//     justify-content: space-between;
//     margin-top: 20px;

//     `
//     button_block.append(searchTextDiv,button)
//     button.className = "btn btn-primary";
//     button.textContent = create_response;
//     cardBody.appendChild(div);
//     div.insertAdjacentElement('beforebegin',button_block)
//   }

// });

// ============== checked js =========== //

// let similarity_input = document.querySelector('.similarity-input')
// similarity_input.addEventListener('change' , (e) => {
//   let select = document.querySelector('.distance-search-file')
//   if(e.target.checked){
//     select.style = `
//     display:block; 
//     visibility: visible;
//     width:300px;
//     `
//   }else{
//     select.style = `
//     display:none; 
//     visibility: hidden;
//     width:0;
//     `
//   }
// })

// ============== checked js end ======= //


// ============== search input js ====== //

// let search_button = document.querySelectorAll('.search-button')
// search_button.forEach(el => {
//   el.addEventListener('click' , () => {
//     let textValue = document.querySelector('#search_input').value;
//     let formInputValue = document.querySelector('.form-input');
//     let searchSinbol = el.getAttribute('data-value')
//     formInputValue = searchSinbol+textValue
//     console.log(formInputValue);
//       formInputValue += `${formInputValue} ${' '} ${searchSinbol}${textValue}`
//   })
// })

// ============== search input js end == //

// ============================================
// checket input js
// ============================================

let all_checked_input = document.querySelector('.all-checked-input')
all_checked_input.addEventListener('change', (e) => {
  let checked_input = document.querySelectorAll('.checked-input')
  checked_input.forEach(el => el.checked = all_checked_input.checked )
})

// ============================================
//  checket input js end
// ============================================


// ============================================
// show file text js
// ============================================

let show_file_text = document.querySelectorAll('.show-file-text')
show_file_text.forEach(icon => icon.addEventListener('click',(e) => {
  let file_text = e.target.querySelector('p').innerHTML
  let file_infon = e.target.closest('tr').querySelector('.file_info').innerText
  let show_file_modal = document.querySelector('.show-file-modal')
  let modal_title = show_file_modal.querySelector('.modal-title')
  let modal_body = show_file_modal.querySelector('.modal-body')
  modal_title.innerText = file_infon
  modal_body.innerHTML = file_text
}))

// ============================================
// show file text js end
// ============================================
// console.log(data);


// ============================================
// save files js
// ============================================
// ============================================
// search files js
// ============================================
let search_file_btn = document.querySelector('.search-file-btn')
  search_file_btn.addEventListener('click',() => {
    let input = document.getElementById('search_input')
    let p = document.querySelector('.search-word')
    p.innerText = input.value
  })

// ============================================
// search files js end
// ============================================

let  save_file_btn = document.querySelector('.save-file-btn')

function saveFunction(){
  let allCheckedInput = document.querySelectorAll('.checked-input')
  let fileArr = []
  allCheckedInput.forEach(el => {
    if(el.checked){
     let text = el.closest('tr').querySelector('.file-text-block').innerText
     fileArr.push(text)
    }
  })
  console.log(fileArr);
}

save_file_btn.addEventListener('click', () => saveFunction())

// ============================================
// save files js end
// ============================================