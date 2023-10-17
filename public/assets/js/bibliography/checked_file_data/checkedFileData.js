// const childs = document.getElementById("child_elems")

// childs.innerHTML = "aha"

///chatgpt

let timeoutId;

function makeEditable(cell) {
    cell.contentEditable = true;
    cell.focus();

    cell.addEventListener("blur", function () {
        clearTimeout(timeoutId); // Очистить предыдущий таймер, если есть
        timeoutId = setTimeout(function () {
            cell.contentEditable = false;
            const newValue = cell.innerText;
            const itemId = cell.getAttribute("data-item-id");
            const column = cell.getAttribute("data-column");
            saveCellValueToServer(itemId, column, newValue);
        }, 1000); // Отправить запрос после 1 секунды задержки
    });
}
// function makeEditable(cell) {
//     cell.contentEditable = true;
//     cell.focus();

//     cell.addEventListener("blur", function () {
//         cell.contentEditable = false;
//         const newValue = cell.innerText;
//         const itemId = cell.getAttribute("data-item-id");
//         const column = cell.getAttribute("data-column");
//         saveCellValueToServer(itemId, column, newValue);
//     });
// }

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
            // let childId = data.child
            let child = data.child;
            const table = document.getElementById("file-data-table");
            const tbody = table.getElementsByTagName("tbody")[0];
            const classNameToRemove = document.querySelectorAll(
                `.child_items-${id}`
            );

            classNameToRemove.forEach((child) => {
                child.remove();
            });
            /////////////////////////////////////////////

            /////////////////////////////////////////////////
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
                /////////checkbox
                const checkbox = document.createElement("td");
                checkbox.setAttribute("scope", "row");
                checkbox.classList.add("td-icon");
                const div = document.createElement("div");
                div.style.textAlign = "center";
                div.classList.add("form-check");
                div.classList.add("icon");
                div.classList.add("icon-sm");
                const checkboxInput = document.createElement("input");
                checkboxInput.classList.add("form-check-input");
                checkboxInput.setAttribute("data-item-id", `${el.man.id}`);
                checkboxInput.setAttribute("data-parent-id", `${id}`);
                checkboxInput.setAttribute("id", `checkbox${el.man.id}`);
                checkboxInput.type = "checkbox";
                div.appendChild(checkboxInput);
                checkbox.appendChild(div);
                newRow.appendChild(checkbox);
                //id
                const idd = document.createElement("td");
                idd.setAttribute("scope", "row");
                idd.textContent = el.man.id;
                newRow.appendChild(idd);
                /////row
                const row = document.createElement("td");
                row.setAttribute("scope", "row");
                newRow.appendChild(row);

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
                if (el.man.first_name !== null) {
                    firstName.textContent = el.man.first_name.first_name;
                } else {
                    firstName.textContent = "";
                }
                newRow.appendChild(firstName);
                ////////lastName
                const lastName = document.createElement("td");
                // lastName.setAttribute("contenteditable", "true");
                lastName.setAttribute("spellcheck", "false");
                if (el.man.last_name !== null) {
                    lastName.textContent = el.man.last_name.last_name;
                } else {
                    lastName.textContent = "";
                }
                newRow.appendChild(lastName);
                // ///////middle_name
                const middleName = document.createElement("td");
                middleName.setAttribute("contenteditable", "true");
                middleName.setAttribute("spellcheck", "false");
                if (el.man.middle_name !== null) {
                    middleName.textContent = el.man.middle_name.middle_name;
                } else {
                    middleName.textContent = "";
                }
                newRow.appendChild(middleName);
                ////////// Create a <td> for el.man.birth_year
                const birthYearCell = document.createElement("td");
                birthYearCell.textContent =
                    el.man.birthday || el.man.birthday_str;
                newRow.appendChild(birthYearCell);
                // Create a <td> with "address"//address
                const address = document.createElement("td");
                address.textContent = "";
                newRow.appendChild(address);
                //description
                const desc = document.createElement("td");
                desc.textContent = "";
                newRow.appendChild(desc);
                //file
                const file = document.createElement("td");
                file.textContent = "";
                newRow.appendChild(file);

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
            let checkboxes = document.querySelectorAll(".form-check-input"); //edit cucak check
            console.log("checkboxes", checkboxes);
            checkboxes.forEach(function (checkbox) {
                checkbox.addEventListener("change", function () {
                    let childId = checkbox.getAttribute("data-item-id");
                    let parentId = checkbox.getAttribute("data-parent-id");
                    console.log("itemId", childId);
                    console.log("parentId", parentId);

                    if (checkbox.checked) {
                        let dataID = {
                            fileItemId: parentId,
                            manId: childId,
                        };
                        sendCheckedId(dataID);
                    }
                });
            });
        })
        .catch((error) => {
            console.log("Произошла ошибка", error);
        });
}

//click to chackbox
let checkboxes = document.querySelectorAll(".form-check-input");

checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener("change", function () {
        let childId = checkbox.getAttribute("data-item-id");
        let parentId = checkbox.getAttribute("data-parent-id");
        console.log("itemId", childId);
        console.log("parentId", parentId);

        if (checkbox.checked) {
            let dataID = {
                fileItemId: parentId,
                manId: childId,
            };
            sendCheckedId(dataID);
        }
    });
});

function sendCheckedId(dataID) {
    fetch(`/likeFileDetailItem`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(dataID),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log("DATA", data);
            //remove child elements
            const classNameToRemove = document.querySelectorAll(
                `.child_items-${dataID.fileItemId}`
            );

            classNameToRemove.forEach((child) => {
                child.remove();
            });
            console.log("parent", dataID.fileItemId);
            console.log("chillldd", dataID.manId);
            //delate process
            const firtstTr = document.getElementById(dataID.fileItemId);
            const newRow = document.createElement("tr");
            newRow.style.backgroundColor = "rgb(195, 194, 194)";
            newRow.id = `${dataID.manId}`;
            newRow.classList.add("start");
            newRow.setAttribute("datafirst-item-id", `${dataID.manId}`);
            // newRow.classList.add(`child_items-${id}`);

            ///icons
            const icons = document.createElement("td");
            icons.setAttribute("scope", "row");
            icons.classList.add("td-icon");
            ///icon div
            let divIcon = document.createElement("div");
            divIcon.className = "td_div_icons";
            /////////checkbox//greenClick
            let iconElement = document.createElement("i");
            iconElement.className =
                "bi icon icon-y icon-base bi-check check_btn";
            iconElement.style.color = "green";
            divIcon.appendChild(iconElement);
            ///back icon
            let backIcon = document.createElement("i");
            backIcon.className = "bi bi-arrow-counterclockwise backIcon";
            backIcon.setAttribute(
                "dataBackIcon-parent-id",
                `${dataID.fileItemId}`
            );
            backIcon.setAttribute("dataBackIcon-child-id", `${dataID.manId}`);
            backIcon.id = "backIcon";
            divIcon.appendChild(backIcon);
            icons.appendChild(divIcon);
            newRow.appendChild(icons);
            //id
            const idd = document.createElement("td");
            idd.setAttribute("scope", "row");
            idd.textContent = data.id; //----?
            newRow.appendChild(idd);
            /////status
            const status = document.createElement("td");
            status.setAttribute("scope", "row");
            status.textContent = data.status;
            newRow.appendChild(status);
            /////////// Create a <td> for el.procent
            const procent = document.createElement("td");
            procent.textContent = data.procent;
            procent.classList.add("td-icon");
            procent.setAttribute("scope", "row");
            newRow.appendChild(procent);
            //////firstName
            const firstName = document.createElement("td");
            // firstName.setAttribute("contenteditable", "true");
            firstName.setAttribute("spellcheck", "false");
            if (data.first_name !== null) {
                firstName.textContent = data.first_name.first_name;
            } else {
                firstName.textContent = "";
            }
            newRow.appendChild(firstName);
            ////////lastName
            const lastName = document.createElement("td");
            // lastName.setAttribute("contenteditable", "true");
            lastName.setAttribute("spellcheck", "false");
            if (data.last_name !== null) {
                lastName.textContent = data.last_name.last_name;
            } else {
                lastName.textContent = "";
            }
            newRow.appendChild(lastName);
            // ///////middle_name
            const middleName = document.createElement("td");
            // middleName.setAttribute("contenteditable", "true");
            middleName.setAttribute("spellcheck", "false");
            if (data.middle_name !== null) {
                middleName.textContent = data.middle_name.middle_name;
            } else {
                middleName.textContent = "";
            }
            newRow.appendChild(middleName);
            ////////// Create a <td> for el.man.birth_year
            const birthYearCell = document.createElement("td");
            birthYearCell.textContent = data.birth_year;
            newRow.appendChild(birthYearCell);

            // Create a <td> with "address"//address
            const address = document.createElement("td");
            address.textContent = "";
            newRow.appendChild(address);
            //description
            const desc = document.createElement("td");
            desc.textContent = "";
            newRow.appendChild(desc);
            //file
            const file = document.createElement("td");
            file.textContent = "";
            newRow.appendChild(file);

            console.log("firtstTr",firtstTr);
            console.log("newRow",newRow);
            // Insert the new row after general_element
            firtstTr.insertAdjacentElement("afterend", newRow);
            firtstTr.remove();
            backIconFunc();
        })
        .catch((error) => {
            console.log("Произошла ошибка", error);
        });
}

////check iconCheck click
function checkButtons(){
  let checkButtons = document.querySelectorAll(".check_btn");
checkButtons.forEach(function (checkButton) {
    checkButton.addEventListener("click", function () {
        let isConfirmed = confirm("Նոր մարդ");

        if (isConfirmed) {
            let checkIcon = document.getElementById("check_btn");
            console.log(checkIcon);
            let fileItemId = this.getAttribute("dataFirst-i-id");
            console.log(fileItemId);
            fetch(`/newFileDataItem`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ fileItemId }),
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(fileItemId);

                    console.log("dataCheck", data);
                    console.log(data.procent);
                    const classNameToRemove = document.querySelectorAll(
                        `.child_items-${fileItemId}`
                    );
                    console.log(classNameToRemove, "classNameToRemove");
                    classNameToRemove.forEach((child) => {
                        child.remove();
                    });

                    //delate process
                    const firtstTr = document.getElementById(fileItemId);
                    console.log(fileItemId);

                    console.log(firtstTr, "firtstTr ");
                    const newRow = document.createElement("tr");
                    newRow.style.backgroundColor = "rgb(195, 194, 194)";
                    // newRow.classList.add(`child_items-${id}`);
                    ///icons
                    const icons = document.createElement("td");
                    icons.setAttribute("scope", "row");
                    icons.classList.add("td-icon");
                    ///icon div
                    let divIcon = document.createElement("div");
                    divIcon.className = "td_div_icons";
                    /////////checkbox//greenClick
                    let iconElement = document.createElement("i");
                    iconElement.className =
                        "bi icon icon-y icon-base bi-check check_btn";
                    iconElement.style.color = "green";
                    divIcon.appendChild(iconElement);
                    ///back icon
                    // let backIcon = document.createElement("i");
                    // backIcon.className =
                    //     "bi bi-arrow-counterclockwise backIcon";
                    // backIcon.id = "backIcon";
                    // divIcon.appendChild(backIcon);
                    icons.appendChild(divIcon);
                    newRow.appendChild(icons);
                    //id
                    const idd = document.createElement("td");
                    idd.setAttribute("scope", "row");
                    idd.textContent = data.id; //----?
                    newRow.appendChild(idd);
                    /////status
                    const status = document.createElement("td");
                    status.setAttribute("scope", "row");
                    status.textContent = data.status;
                    newRow.appendChild(status);
                    /////////// Create a <td> for el.procent
                    const procent = document.createElement("td");
                    procent.textContent = data.procent;
                    procent.classList.add("td-icon");
                    procent.setAttribute("scope", "row");
                    newRow.appendChild(procent);
                    //////firstName
                    const firstName = document.createElement("td");
                    // firstName.setAttribute("contenteditable", "true");
                    firstName.setAttribute("spellcheck", "false");
                    if (data.first_name !== null) {
                        firstName.textContent = data.first_name.first_name;
                    } else {
                        firstName.textContent = "";
                    }
                    newRow.appendChild(firstName);
                    ////////lastName
                    const lastName = document.createElement("td");
                    // lastName.setAttribute("contenteditable", "true");
                    lastName.setAttribute("spellcheck", "false");
                    if (data.last_name !== null) {
                        lastName.textContent = data.last_name.last_name;
                    } else {
                        lastName.textContent = "";
                    }
                    newRow.appendChild(lastName);
                    // ///////middle_name
                    const middleName = document.createElement("td");
                    // middleName.setAttribute("contenteditable", "true");
                    middleName.setAttribute("spellcheck", "false");
                    if (data.middle_name !== null) {
                        middleName.textContent = data.middle_name.middle_name;
                    } else {
                        middleName.textContent = "";
                    }
                    newRow.appendChild(middleName);
                    ////////// Create a <td> for el.man.birth_year
                    const birthYearCell = document.createElement("td");
                    birthYearCell.textContent = data.birth_year;
                    newRow.appendChild(birthYearCell);

                    // Create a <td> with "address"//address
                    const address = document.createElement("td");
                    address.textContent = "";
                    newRow.appendChild(address);
                    //description
                    const desc = document.createElement("td");
                    desc.textContent = "";
                    newRow.appendChild(desc);
                    //file
                    const file = document.createElement("td");
                    file.textContent = "";
                    newRow.appendChild(file);
                    // Insert the new row after general_element
                    firtstTr.insertAdjacentElement("afterend", newRow);
                    firtstTr.remove();
                });
        } else {
            console.log("Действие отменено.");
        }
    });
});
}
checkButtons()

///colorText side
// var elementsWithClass = document.getElementsByClassName("find-by-class");
// function scrollToElement(index) {
//     if (index < elementsWithClass.length) {
//         elementsWithClass[index].scrollIntoView({ behavior: "smooth" });

//         setTimeout(function () {
//             scrollToElement(index + 1);
//         }, 1000);
//     }
// }

// scrollToElement(0);



//back icon
// let backIcon = document.querySelectorAll(".backIcon");
function backIconFunc() {
    let backIcon = document.querySelectorAll(".backIcon");
    backIcon.forEach(function (back) {
        back.addEventListener("click", function () {
            let isConfirmed = confirm("hastat?");
            if (isConfirmed) {
                let parentId = this.getAttribute("dataBackIcon-parent-id");
                let childId = this.getAttribute("dataBackIcon-child-id");
                console.log("parentId", parentId);
                fetch(`/bringBackLikedData`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ parentId }),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        // alert(childId )
                        // alert(parentId)

                        console.log(document.querySelectorAll(".backicon"),8888);
                        console.log(data);
                        console.log(data.editable);
                        console.log(typeof data.address);
                        console.log("childId", childId);

                        const childrens = data.child;
                        const parent_element = document.getElementById(childId);
                        console.log("parent_element", parent_element);
                        const newTr = document.createElement("tr");
                        newTr.id =`${parentId}`;
                        newTr.classList.add("start");
                        newTr.setAttribute("datafirst-item-id", `${parentId}`);
                        ///icons
                        const icons = document.createElement("td");
                        icons.setAttribute("scope", "row");
                        icons.classList.add("td-icon");
                        ///icon div
                        let divIcon = document.createElement("div");
                        divIcon.className = "td_div_icons";
                        /////////checkbox//greenClick--
                        let iconElement = document.createElement("i");
                        iconElement.className =
                            "bi icon icon-y icon-base bi-check check_btn";
                        iconElement.id = "check_btn";
                        iconElement.setAttribute(
                            "dataFirst-i-id",
                            `${parentId}`
                        );
                        // iconElement.style.color = "green";--
                        divIcon.appendChild(iconElement);
                        icons.appendChild(divIcon);
                        newTr.appendChild(icons);
                        //id
                        const idd = document.createElement("td");
                        idd.setAttribute("scope", "row");
                        idd.textContent = data.id; //----?
                        newTr.appendChild(idd);
                        /////status
                        const status = document.createElement("td");
                        status.setAttribute("scope", "row");
                        status.textContent = data.status;
                        newTr.appendChild(status);
                        /////////// Create a <td> for el.procent
                        const procent = document.createElement("td");
                        procent.textContent = data.procent;
                        procent.classList.add("td-icon");
                        procent.setAttribute("scope", "row");
                        newTr.appendChild(procent);
                        //////firstName
                        const firstName = document.createElement("td");
                        firstName.setAttribute("contenteditable", `${data.editable}`);
                        firstName.setAttribute("spellcheck", "false");
                        firstName.setAttribute("data-item-id",`${data.id}`);
                        firstName.setAttribute("data-column", "name");
                        firstName.setAttribute('onclick', 'makeEditable(this)')
                        if (data.name !== null) {
                            firstName.textContent = data.name;
                        } else {
                            firstName.textContent = "";
                        }
                        newTr.appendChild(firstName);
                        ////////lastName
                        const lastName = document.createElement("td");
                        lastName.setAttribute("contenteditable", `${data.editable}`);
                        lastName.setAttribute("spellcheck", "false");
                        lastName.setAttribute("data-item-id",`${data.id}`);
                        lastName.setAttribute("data-column", "surname");
                        lastName.setAttribute('onclick', 'makeEditable(this)')
                        if (data.surname !== null) {
                            lastName.textContent = data.surname;
                        } else {
                            lastName.textContent = "";
                        }
                        newTr.appendChild(lastName);
                        // ///////middle_name
                        const middleName = document.createElement("td");
                        middleName.setAttribute("contenteditable", `${data.editable}`);
                        middleName.setAttribute("spellcheck", "false");
                        middleName.setAttribute("data-item-id",`${data.id}`);
                        middleName.setAttribute("data-column", "patronymic");
                        middleName.setAttribute('onclick', 'makeEditable(this)')
                        if (data.patronymic !== null) {
                            middleName.textContent = data.patronymic;
                        } else {
                            middleName.textContent = "";
                        }
                        newTr.appendChild(middleName);
                        ////////// Create a <td> for el.man.birth_year
                        const birthYearCell = document.createElement("td");
                        birthYearCell.setAttribute("spellcheck", "false");
                        birthYearCell.setAttribute("data-item-id",`${data.id}`);
                        birthYearCell.setAttribute("data-column", "birthday");
                        birthYearCell.textContent = data.birth_year;
                        newTr.appendChild(birthYearCell);

                        // Create a <td> with "address"//address
                        const address = document.createElement("td");
                        address.setAttribute("spellcheck", "false");
                        address.setAttribute("data-item-id",`${data.id}`);
                        address.setAttribute("data-column", "address");
                        address.textContent = data.address;
                        newTr.appendChild(address);
                        //description
                        const desc = document.createElement("td");
                        desc.className = "td-lg td-scroll-wrapper";
                        const div = document.createElement("div");
                        div.classList.add("td-scroll");
                        div.textContent = data.paragraph;
                        desc.appendChild(div);
                        newTr.appendChild(desc);
                        //file
                        const file = document.createElement("td");
                        file.textContent = data.real_file_name;
                        newTr.appendChild(file);
                        // Insert the new row after general_element
                        console.log(newTr, 77777777777777777777777);
                        console.log(parent_element, 88888888888);
                        parent_element.insertAdjacentElement("afterend", newTr);

                        //////////////childrens logic

                        childrens.forEach((el) => {
                            // Create a new table row for each <td>
                            const newRow = document.createElement("tr");
                            newRow.classList.add(`child_items-${data.id}`);
                            /////////checkbox
                            const checkbox = document.createElement("td");
                            checkbox.setAttribute("scope", "row");
                            checkbox.classList.add("td-icon");
                            const div = document.createElement("div");
                            // div.style.textAlign = "center";
                            div.classList.add("form-check");
                            div.classList.add("icon");
                            div.classList.add("icon-sm");
                            const checkboxInput =
                             document.createElement("input");
                            checkboxInput.classList.add("form-check-input");
                            checkboxInput.type = "checkbox";
                            checkboxInput.setAttribute("id",`checkbox${el.man.id}`);
                            checkboxInput.setAttribute("data-item-id",`${el.man.id}`);
                            checkboxInput.setAttribute("data-parent-id",`${data.id}`);
                            div.appendChild(checkboxInput);
                            checkbox.appendChild(div);
                            newRow.appendChild(checkbox);
                            //id
                            const idd = document.createElement("td");
                            idd.setAttribute("scope", "row");
                            idd.textContent = el.man.id;
                            newRow.appendChild(idd);
                            /////row
                            const row = document.createElement("td");
                            row.setAttribute("scope", "row");
                            newRow.appendChild(row);

                            /////////// Create a <td> for el.procent
                            const procent = document.createElement("td");
                            procent.textContent = el.procent
                                .toString()
                                .slice(0, 5);
                            procent.classList.add("td-icon");
                            procent.setAttribute("scope", "row");
                            newRow.appendChild(procent);
                            //////firstName
                            const firstName = document.createElement("td");
                            // firstName.setAttribute("contenteditable", "true");
                            firstName.setAttribute("spellcheck", "false");
                            if (el.man.first_name !== null) {
                                firstName.textContent =
                                    el.man.first_name.first_name;
                            } else {
                                firstName.textContent = "";
                            }
                            newRow.appendChild(firstName);
                            ////////lastName
                            const lastName = document.createElement("td");
                            // lastName.setAttribute("contenteditable", "true");
                            lastName.setAttribute("spellcheck", "false");
                            if (el.man.last_name !== null) {
                                lastName.textContent =
                                    el.man.last_name.last_name;
                            } else {
                                lastName.textContent = "";
                            }
                            newRow.appendChild(lastName);
                            // ///////middle_name
                            const middleName = document.createElement("td");
                            middleName.setAttribute("contenteditable", "true");
                            middleName.setAttribute("spellcheck", "false");
                            if (el.man.middle_name !== null) {
                                middleName.textContent =
                                    el.man.middle_name.middle_name;
                            } else {
                                middleName.textContent = "";
                            }
                            newRow.appendChild(middleName);
                            ////////// Create a <td> for el.man.birth_year
                            const birthYearCell = document.createElement("td");
                            birthYearCell.textContent =
                                el.man.birthday || el.man.birthday_str;
                            newRow.appendChild(birthYearCell);
                            // Create a <td> with "address"//address
                            const address = document.createElement("td");
                            address.textContent = "";
                            newRow.appendChild(address);
                            //description
                            const desc = document.createElement("td");
                            desc.textContent = "";
                            newRow.appendChild(desc);
                            //file
                            const file = document.createElement("td");
                            file.textContent = "";
                            newRow.appendChild(file);

                            // Insert the new row after general_element
                            newTr.insertAdjacentElement("afterend", newRow);
                            let checkboxes =
                                document.querySelectorAll(".form-check-input"); //edit cucak check
                            // console.log("checkboxes", checkboxes);
                            checkboxes.forEach(function (checkbox) {
                                checkbox.addEventListener("change",function () {
                                        let childId =checkbox.getAttribute("data-item-id");
                                        let parentId =checkbox.getAttribute("data-parent-id");
                                        console.log("itemId", childId);
                                        console.log("parentId", parentId);

                                        if (checkbox.checked) {
                                            let dataID = {
                                                fileItemId: parentId,
                                                manId: childId,
                                            };
                                            sendCheckedId(dataID);
                                        }
                                    }
                                );
                            });

                        });
                        //back-i iconic check button click 
                        checkButtons()
                        parent_element.remove();
                    });
                // let backIconArray = Array.from(backIcon);
                // backIconArray = backIconArray.concat(newTr);
                // let updatedBackIcons = document.querySelectorAll(".backIcon");
            } else {
                console.log("bbo");
            }
        });
    });
}

backIconFunc();
// backIcon.forEach(function (back) {
//     back.addEventListener("click", function () {
//         let isConfirmed = confirm("hastat?");
//         if (isConfirmed) {
//             let parentId = this.getAttribute("dataBackIcon-parent-id");
//             let childId = this.getAttribute("dataBackIcon-child-id");
//             console.log("parentId", parentId);
//             fetch(`/bringBackLikedData`, {
//                 method: "POST",
//                 headers: {
//                     "Content-Type": "application/json",
//                 },
//                 body: JSON.stringify({ parentId }),
//             })
//                 .then((response) => response.json())
//                 .then((data) => {
//                   console.log( document.querySelectorAll(".backicon"), 8888)
//                     console.log(data);
//                     console.log("childId", childId);
//                     const childrens = data.child
//                     const parent_element = document.getElementById(childId);
//                     const newTr = document.createElement("tr");
//                     ///icons
//                     const icons = document.createElement("td");
//                     icons.setAttribute("scope", "row");
//                     icons.classList.add("td-icon");
//                     ///icon div
//                     let divIcon = document.createElement("div");
//                     divIcon.className = "td_div_icons";
//                     /////////checkbox//greenClick
//                     let iconElement = document.createElement("i");
//                     iconElement.className =
//                         "bi icon icon-y icon-base bi-check check_btn";
//                     // iconElement.style.color = "green";
//                     divIcon.appendChild(iconElement);

//                     //id
//                     const idd = document.createElement("td");
//                     idd.setAttribute("scope", "row");
//                     idd.textContent = data.id; //----?
//                     newTr.appendChild(idd);
//                     /////status
//                     const status = document.createElement("td");
//                     status.setAttribute("scope", "row");
//                     status.textContent = data.status;
//                     newTr.appendChild(status);
//                     /////////// Create a <td> for el.procent
//                     const procent = document.createElement("td");
//                     procent.textContent = data.procent;
//                     procent.classList.add("td-icon");
//                     procent.setAttribute("scope", "row");
//                     newTr.appendChild(procent);
//                     //////firstName
//                     const firstName = document.createElement("td");
//                     // firstName.setAttribute("contenteditable", "true");
//                     firstName.setAttribute("spellcheck", "false");
//                     firstName.setAttribute("contenteditable", "true");
//                     if (data.name !== null) {
//                         firstName.textContent = data.name;
//                     } else {
//                         firstName.textContent = "";
//                     }
//                     newTr.appendChild(firstName);
//                     ////////lastName
//                     const lastName = document.createElement("td");
//                     // lastName.setAttribute("contenteditable", "true");
//                     lastName.setAttribute("spellcheck", "false");
//                     if (data.surname !== null) {
//                         lastName.textContent = data.surname;
//                     } else {
//                         lastName.textContent = "";
//                     }
//                     newTr.appendChild(lastName);
//                     // ///////middle_name
//                     const middleName = document.createElement("td");
//                     // middleName.setAttribute("contenteditable", "true");
//                     middleName.setAttribute("spellcheck", "false");
//                     if (data.patronymic !== null) {
//                         middleName.textContent = data.patronymic;
//                     } else {
//                         middleName.textContent = "";
//                     }
//                     newTr.appendChild(middleName);
//                     ////////// Create a <td> for el.man.birth_year
//                     const birthYearCell = document.createElement("td");
//                     birthYearCell.textContent = data.birth_year;
//                     newTr.appendChild(birthYearCell);

//                     // Create a <td> with "address"//address
//                     const address = document.createElement("td");
//                     address.textContent = data.address;
//                     newTr.appendChild(address);
//                     //description
//                     const desc = document.createElement("td");
//                     desc.className = "td-lg td-scroll-wrapper";
//                     const div = document.createElement("div");
//                     div.classList.add("td-scroll");
//                     div.textContent = data.paragraph;
//                     desc.appendChild(div);
//                     newTr.appendChild(desc);
//                     //file
//                     const file = document.createElement("td");
//                     file.textContent = data.real_file_name;
//                     newTr.appendChild(file);
//                     // Insert the new row after general_element
//                     parent_element.insertAdjacentElement("afterend", newTr);

//                     //////////////childrens logic

//                     childrens.forEach((el) => {
//                       // Create a new table row for each <td>
//                       const newRow = document.createElement("tr");
//                       newRow.classList.add(`child_items-${data.id}`);
//                       /////////checkbox
//                       const checkbox = document.createElement("td");
//                       checkbox.setAttribute("scope", "row");
//                       checkbox.classList.add("td-icon");
//                       const div = document.createElement("div");
//                       div.style.textAlign = "center";
//                       div.classList.add("form-check");
//                       div.classList.add("icon");
//                       div.classList.add("icon-sm");
//                       const checkboxInput = document.createElement("input");
//                       checkboxInput.classList.add("form-check-input");
//                       checkboxInput.setAttribute("data-item-id", `${el.man.id}`);
//                       checkboxInput.setAttribute("data-parent-id", `${data.id}`);
//                       checkboxInput.setAttribute("id", `checkbox${el.man.id}`);
//                       checkboxInput.type = "checkbox";
//                       div.appendChild(checkboxInput);
//                       checkbox.appendChild(div);
//                       newRow.appendChild(checkbox);
//                       //id
//                       const idd = document.createElement("td");
//                       idd.setAttribute("scope", "row");
//                       idd.textContent = el.man.id;
//                       newRow.appendChild(idd);
//                       /////row
//                       const row = document.createElement("td");
//                       row.setAttribute("scope", "row");
//                       newRow.appendChild(row);

//                       /////////// Create a <td> for el.procent
//                       const procent = document.createElement("td");
//                       procent.textContent = el.procent.toString().slice(0, 5);
//                       procent.classList.add("td-icon");
//                       procent.setAttribute("scope", "row");
//                       newRow.appendChild(procent);
//                       //////firstName
//                       const firstName = document.createElement("td");
//                       // firstName.setAttribute("contenteditable", "true");
//                       firstName.setAttribute("spellcheck", "false");
//                       if (el.man.first_name !== null) {
//                           firstName.textContent = el.man.first_name.first_name;
//                       } else {
//                           firstName.textContent = "";
//                       }
//                       newRow.appendChild(firstName);
//                       ////////lastName
//                       const lastName = document.createElement("td");
//                       // lastName.setAttribute("contenteditable", "true");
//                       lastName.setAttribute("spellcheck", "false");
//                       if (el.man.last_name !== null) {
//                           lastName.textContent = el.man.last_name.last_name;
//                       } else {
//                           lastName.textContent = "";
//                       }
//                       newRow.appendChild(lastName);
//                       // ///////middle_name
//                       const middleName = document.createElement("td");
//                       middleName.setAttribute("contenteditable", "true");
//                       middleName.setAttribute("spellcheck", "false");
//                       if (el.man.middle_name !== null) {
//                           middleName.textContent = el.man.middle_name.middle_name;
//                       } else {
//                           middleName.textContent = "";
//                       }
//                       newRow.appendChild(middleName);
//                       ////////// Create a <td> for el.man.birth_year
//                       const birthYearCell = document.createElement("td");
//                       birthYearCell.textContent =
//                           el.man.birthday || el.man.birthday_str;
//                       newRow.appendChild(birthYearCell);
//                       // Create a <td> with "address"//address
//                       const address = document.createElement("td");
//                       address.textContent = "address";
//                       newRow.appendChild(address);
//                       //description
//                       const desc = document.createElement("td");
//                       desc.textContent = "description";
//                       newRow.appendChild(desc);
//                       //file
//                       const file = document.createElement("td");
//                       file.textContent = "file";
//                       newRow.appendChild(file);

//                       // Insert the new row after general_element
//                       newTr.insertAdjacentElement("afterend", newRow);
//                       let checkboxes = document.querySelectorAll(".form-check-input"); //edit cucak check
//                       console.log("checkboxes", checkboxes);
//                       checkboxes.forEach(function (checkbox) {
//                           checkbox.addEventListener("change", function () {
//                               let childId = checkbox.getAttribute("data-item-id");
//                               let parentId = checkbox.getAttribute("data-parent-id");
//                               console.log("itemId", childId);
//                               console.log("parentId", parentId);

//                               if (checkbox.checked) {
//                                   let dataID = {
//                                       fileItemId: parentId,
//                                       manId: childId,
//                                   };
//                                   sendCheckedId(dataID);
//                               }
//                           });
//                       });
//                   });
//                     parent_element.remove();
//                 });
//                 // let backIconArray = Array.from(backIcon);
//                 // backIconArray = backIconArray.concat(newTr);
//                 // let updatedBackIcons = document.querySelectorAll(".backIcon");
//         } else {
//             console.log("bbo");
//         }
//     });

// });
