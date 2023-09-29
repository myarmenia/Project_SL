// const childs = document.getElementById("child_elems")

// childs.innerHTML = "aha"

function makeEditable(cell) {
    cell.contentEditable = true;
    cell.focus();

    cell.addEventListener("blur", function () {
        cell.contentEditable = false;
        const newValue = cell.innerText;
        const itemId = cell.getAttribute("data-item-id");
        const column = cell.getAttribute("data-column");
        saveCellValueToServer(itemId, column, newValue);
    });
}

function saveCellValueToServer(itemId, column, newValue) {
    fetch(`/editFileDetailItem/${itemId}`, {
        method: "PATCH",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ column, newValue }),
    })
        .then((response) => response.json())
        .then((data) => {
            // document.getElementById('child_items-').innerHTML=
            console.log(data);
            let id = data.id;
            let child = data.child;
            const table = document.getElementById("file-data-table");
            const tbody = table.getElementsByTagName("tbody")[0];
            const classNameToRemove = document.querySelectorAll(
                `.child_items-${id}`
            );

            classNameToRemove.forEach((child) => {
                child.remove();
            });

            // const tbody_element = document.querySelector(".tbody_elements");

            const general_element = document.getElementById(id); //
            // const dataItemId = general_element.getAttribute("dataFirst-item-id");
            // const tr = document.createElement("tr");
            // tr.classList.add(`child_items-${id}`); //
            // const td = document.createElement("td");
            //   const entries = Object.entries(data)
            //  let k1 = ''
            //  entries.map(elem=>{
            //     k1 += `
            //     <td>sdsd</td>
            //     <td>${elem.name}</td>
            //     <td>New cell 3</td>`
            //   })
            // let k1 = "";
            // child.map((el) => {
            //     k1 += `
            //  <td>${el.man.birth_year}</td>
            //  <td>${el.procent}</td>
            //  <td>New cell 3</td>
            //   `;
            // });
            // tr.innerHTML = k1;
            child.forEach((el) => {
                // Create a new table row for each <td>
                const newRow = document.createElement("tr");
                newRow.classList.add(`child_items-${id}`);
                /////row
                const row = document.createElement("td");
                row.setAttribute("scope", "row");
                newRow.appendChild(row);
                /////////checkbox
                const checkbox = document.createElement("td");
                checkbox.setAttribute("scope", "row");
                checkbox.classList.add("td-icon");
                const div = document.createElement("div");
                // div.classList.add("form-check icon icon-sm")
                const checkboxInput = document.createElement("input");
                checkboxInput.classList.add("form-check-input");
                checkboxInput.type = "checkbox";
                div.appendChild(checkboxInput);
                checkbox.appendChild(div);
                newRow.appendChild(checkbox);
                /////////// Create a <td> for el.procent
                const procent = document.createElement("td");
                procent.textContent = el.procent.toString().slice(0, 5);
                procent.classList.add("td-icon");
                procent.setAttribute("scope", "row");
                newRow.appendChild(procent);
                //////firstName
                const firstName = document.createElement("td");
                // firstName.setAttribute("contenteditable", "true");
                firstName.setAttribute("spellcheck", "false");
                if (el.man.first_name.first_name !== null) {
                    firstName.textContent = el.man.first_name.first_name;
                } else {
                    firstName.textContent = "";
                }
                newRow.appendChild(firstName);
                ////////lastName
                const lastName = document.createElement("td");
                // lastName.setAttribute("contenteditable", "true");
                lastName.setAttribute("spellcheck", "false");
                if (el.man.last_name.last_name !== null) {
                    lastName.textContent = el.man.last_name.last_name;
                } else {
                    lastName.textContent = "";
                }
                newRow.appendChild(lastName);
                // ///////middle_name
                // const middleName = document.createElement("td");
                // middleName.setAttribute("contenteditable", "true");
                // middleName.setAttribute("spellcheck", "false");
                // if (el.man.middle_name.middle_name !== null) {
                //   middleName.textContent = el.man.middle_name.middle_name;
                // } else {
                //   middleName.textContent = "asda";
                // }
                // newRow.appendChild(middleName);
                ////////// Create a <td> for el.man.birth_year
                const birthYearCell = document.createElement("td");
                birthYearCell.textContent = el.man.birth_year;
                newRow.appendChild(birthYearCell);

                // Create a <td> with "New cell 3"
                const newCell3 = document.createElement("td");
                newCell3.textContent = "New cell 3";
                newRow.appendChild(newCell3);

                // Insert the new row after general_element
                general_element.insertAdjacentElement("afterend", newRow);
            });

            // tr.innerHTML = child.map((el) => {
            //     `
            // <td>sdsd</td>
            // <td>${el.procent}</td>
            // <td>New cell 3</td>`;
            // });
            // tr.innerHTML = `
            // <td>sdsd</td>
            // <td>${data.name}</td>
            // <td>New cell 3</td>`;
            // tr.appendChild(td);
            // if (dataItemId === id) {

            //     general_element.insertAdjacentElement("afterend", tr);
            // }

            // general_element.appendChild(tr);
            // console.log("tbody_element", tbody_element);
            // const tr = generalElement.appendChild(document.createElement("tr"));
            // const td = tr.appendChild(document.createElement("td"))
            // td.innerHTML = "hassfghdga";
            // console.log(tbody, 99999);

            // var parenttbl = document.getElementsByTagName("general_element");
            // console.log(parenttbl, 777)
            // var newel = document.createElement('td');
            // var elementid = document.getElementsByTagName("td").length
            // newel.setAttribute('id',elementid);
            // newel.innerHTML = "New Inserted"
            // parenttbl[0].appendChild(newel);
        })
        .catch((error) => {
            console.log("Произошла ошибка", error);
        });
}
