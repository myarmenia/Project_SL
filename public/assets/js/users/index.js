// isActive notActive js //

const allRangeInp = document.querySelectorAll(".rangeInput");
allRangeInp.forEach((el) => {
    el.addEventListener("change", (e) => {

    let cancel = document.querySelector("#cancel_btn");
    let confirm = document.querySelector("#isActive_button")

    cancel.onclick = () => {
      if (e.target.value === "1") {
        e.target.value = 0;
      } else if (e.target.value === "0") {
        e.target.value = 1;
      }
    };

    // confirm.onclick = () => {
        let url = e.target.closest(".table").getAttribute("data-status-url");
        let statusForm = document.querySelector('#status_form')
        let dataId = e.target.closest('tr').getAttribute('data-id')
        let finish_url = url + dataId + "/" + e.target.value;
        statusForm.setAttribute('action', finish_url);
    // }
  });
});


let allLogElements = document.querySelectorAll('.current-id');

allLogElements.forEach(el => {
  el.addEventListener('click', () => {
    let response = null
    el.getAttribute('data-info') !== '' ? response = JSON.parse(el.getAttribute('data-info')) : ''
    if(response !== null){
      response = Object.entries(response).map(([key, value]) => ({ key, value }));
      createDynamicTableLog(response) 
      allLogElements.forEach((el) => {
              el.classList.remove("backgroundClass");
          });
          if (el !== allLogElements[0]) {
              el.classList.add("backgroundClass");
          }
    }else{
      remuveDinamicTable()
      allLogElements.forEach((el) => {
        el.classList.remove("backgroundClass");
    });
    if (el !== allLogElements[0]) {
        el.classList.add("backgroundClass");
    }
    }
  })
    
});

// -------------------------- dinamic table log -------------------------------- //

function createDynamicTableLog(response) {
  remuveDinamicTable()
  let card_body = document.querySelector(".card-body");
  const table = document.createElement("table");
  table.className = "dinamic-table";
  const tr_th = document.createElement("tr");
  tr_th.innerHTML = `
    <th>Դաշտի անվանում</th>
    <th>Արժեքներ</th>
  `;
  table.appendChild(tr_th);
  for (i = 0; i < response.length ; i++) {
      let dinamic_tr = document.createElement("tr");
      let td_name = response[i].key
      let td_text =  response[i].value
      dinamic_tr.innerHTML = `
      <td>${td_name}</td>
      <td>${td_text}</td>
      `;
      table.appendChild(dinamic_tr);
  }

  let dinamic_div = document.createElement("div");
  dinamic_div.className = "dinamic_div";
  dinamic_div.appendChild(table);
  card_body.appendChild(dinamic_div);
  setTimeout(() => {
      table.style = `
    transform: rotateX(0deg);
    `;
  }, 100);
  window.scrollTo(0, document.body.scrollHeight);
} 

// const allTr = document.querySelectorAll(".table tr");
// function dinamicTableFunction(e, tr) {
//   remuveDinamicTable();
//   const allTh = document.querySelectorAll(".table th");
//   allTr.forEach((el) => {
//       el.classList.remove("backgroundClass");
//   });
//   if (tr !== allTr[0]) {
//       tr.classList.add("backgroundClass");
//   }
//   createDynamicTableLog(allTh, tr);
// }

// allTr.forEach((el) => {
//   el.addEventListener("click", (e) => dinamicTableFunction(e, el));
// });

// --------- remuve dinamic Table ------------------- //

function remuveDinamicTable() {
  const dinamic_div = document.querySelector(".dinamic_div");
  dinamic_div?.remove();
  window.scrollTo(0, document.body.scrollTop);
}
document.addEventListener("click", (e) => {
  let tr = document.querySelectorAll(".table tr");
  if (e.target.localName !== "td") {
      if (e.target.className !== "table_div") {
          remuveDinamicTable();
          tr.forEach((el) => {
              el.classList.remove("backgroundClass");
          });
      }
  }
});

// --------- end remuve dinamic Table ------------------- //