// -------------------------- dinamic table users -------------------------------- //

function createDynamicTable(allTh, tr) {

    let card_body = document.querySelector('.card-body')
    let thArr = [];
    let tdArr = [];
    let idIndex = null;
    const table = document.createElement("table");
    table.className = "dinamic-table";
    allTh.forEach((el, index) => {
      el.innerText === "Id" ? (idIndex = index) : "";
      thArr.push(el.innerText);
      if (idIndex !== null) {
        let key = thArr[index];
        let value = tr.children[index].innerText;
        value !== "" ? tdArr.push({ key: key, value: value, index:index}) : "";
      }
    });
  
    const tr_th = document.createElement('tr')
    tr_th.innerHTML = `
      <th>Համար</th>
      <th>Դաշտի անվանում</th>
      <th>Արժեքներ</th>
    `
    table.appendChild(tr_th)
    for (i = 0; i < tdArr.length; i++) {
        let dinamic_tr = document.createElement("tr");
        let td_name = tdArr[i].key;
        let td_text = tdArr[i].value;
        dinamic_tr.innerHTML = `
        <td>Համար</td>
        <td>${td_name}</td>
        <td>${td_text}</td>
        `
        table.appendChild(dinamic_tr);
      }
  
      let dinamic_div= document.createElement('div')
      dinamic_div.className = 'dinamic_div' 
      dinamic_div.appendChild(table)
      card_body.appendChild(dinamic_div)
      setTimeout(() => {
        table.style = `
      transform: rotateX(0deg);
      `
      },100)
      window.scrollTo(0,document.body.scrollHeight)
  } 
  
  
  const allTr = document.querySelectorAll(".table tr");
  function dinamicTableFunction(e,tr) {
    console.log(tr);
    remuveDinamicTable()
    const allTh = document.querySelectorAll(".table th");
    allTr.forEach((el) => {
      el.classList.remove('backgroundClass')
    });
    if (tr !== allTr[0]) {
      tr.classList.add('backgroundClass')
    }
    createDynamicTable(allTh, tr);
  }
  
  allTr.forEach((el) => {
    el.addEventListener("click", (e) => dinamicTableFunction(e,el));
  });
  
  // --------- remuve dinamic Table ------------------- //
  
  function remuveDinamicTable () {
    const  dinamic_div = document.querySelector('.dinamic_div')
    dinamic_div?.remove()
    window.scrollTo(0,document.body.scrollTop)
  }
  document.addEventListener('click', (e) => {
    let tr = document.querySelectorAll('.table tr')
    let table_div = document.querySelector('.table_div')
      if(e.target.localName !== 'td' ){
        if(e.target.className !== 'table_div'){
          remuveDinamicTable()
          table_div.style.height = '560px'
          tr.forEach(el => {
            el.classList.remove('backgroundClass')
          })
        }
      } 
  })
  // --------- end remuve dinamic Table ------------------- //