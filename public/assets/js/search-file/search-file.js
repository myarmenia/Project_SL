const serachButton = document.getElementById("serach_button");
let cardBody = document.querySelector(".card-body");

serachButton.addEventListener("click", () => {
  let activTable = document.querySelector(".table");
  if (!activTable) {
    
    let searchButtonInp = document.getElementById("search_text");
    let searchInput = document.getElementById("search_input");

    let searchTextDiv = document.createElement("div");
    searchTextDiv.textContent = searchInput.value;
    searchTextDiv.style = `
      border: 1px solid;
      width: fit-content;
      padding: 6px;
      border-radius: 10px;
  `;
    searchButtonInp.insertAdjacentElement("afterend", searchTextDiv);
    
    ///////////table create ////////////////
    let div = document.createElement("div");
    div.style = `
  overflow: auto;
  padding-bottom: 20px;
  `;
    let table = document.createElement("table");
    let tbody = document.createElement("tbody");
    let thead = document.createElement("thead");

    table.className = "person_table table";
    table.style.marginTop = "30px";
    let trTh = document.createElement("tr");

    trTh.innerHTML = `
      <th>id</th>
      <th>${association}</th>
      <th>${keyword}</th>
      <th>${fileName}</th>
      <th>${contactPerson}</th>
  `;

    thead.appendChild(trTh);
    table.appendChild(thead);

    let trTd = document.createElement("tr");
    trTd.innerHTML = `
<td>tiv</td>
<td class="input-td change-td" style="text-align: center"><input type="checkbox" class="form-check-input"/></td>
<td class="input-td change-td" >${searchInput.value}</td>
<td class="input-td change-td" >cccc</td>
<td class ='change-td-btn'></td>
`;
    tbody.appendChild(trTd);
    table.appendChild(tbody);
    div.appendChild(table);
    searchInput.value =""

    let button = document.createElement("button");
    button.className = "btn btn-primary";
    button.textContent = create_response;
    button.style.marginTop = "32px";
    table.appendChild(button);
    cardBody.appendChild(div);
  }

});
