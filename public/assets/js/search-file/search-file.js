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



let all_checked_input = document.querySelector('.all-checked-input')
console.log(all_checked_input);
all_checked_input.addEventListener('change', (e) => {
  let checked_input = document.querySelectorAll('.checked-input')
  checked_input.forEach(el => el.checked = all_checked_input.checked )
  // console.log(all_checked_input.checked);

})
