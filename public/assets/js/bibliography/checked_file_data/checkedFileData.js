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
    let csrf = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    fetch(`/editFileDetailItem/${itemId}`, {
        method: "PATCH",
        headers: {
            "Content-Type": "application/json",
            // 'X-CSRF-TOKEN':csrf
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
                // middleName.setAttribute("contenteditable", "true");
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
                let divFile = document.createElement("div");
                divFile.classList.add("file-box-title");
                let aElement = document.createElement("a");
                aElement.target = "_blank";
                let iElement = document.createElement("i");
                iElement.className = "bi bi-eye open-eye";
                iElement.setAttribute("data-id", el.man.id);
                iElement.addEventListener('click',(e) =>showCnntact(e))
                let spanElement = document.createElement("span");
                aElement.appendChild(iElement);
                aElement.appendChild(spanElement);
                divFile.appendChild(aElement);
                file.appendChild(divFile);
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
    let csrf = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    fetch(`/likeFileDetailItem`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            // 'X-CSRF-TOKEN':csrf
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
            // //file
            const file = document.createElement("td");
            let divFile = document.createElement("div");
            divFile.classList.add("file-box-title");
            if (!data.editable) {
                let aElement = document.createElement("a");
                aElement.target = "_blank";
                let iElement = document.createElement("i");
                iElement.className = "bi bi-eye open-eye";
                iElement.setAttribute("data-id", data.id);
                iElement.addEventListener('click',(e) =>showCnntact(e))
                let spanElement = document.createElement("span");
                aElement.appendChild(iElement);
                aElement.appendChild(spanElement);
                divFile.appendChild(aElement);
            }
            file.appendChild(divFile);
            newRow.appendChild(file);

            console.log("firtstTr", firtstTr);
            console.log("newRow", newRow);
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
function checkButtons() {
    let checkButtons = document.querySelectorAll(".check_btn");
    checkButtons.forEach(function (checkButton) {
        checkButton.addEventListener("click", function () {
            // let isConfirmed = confirm("Նոր մարդ");
            let csrf = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");

            // if (isConfirmed) {
            let checkIcon = document.getElementById("check_btn");
            console.log(checkIcon);
            let fileItemId = this.getAttribute("dataFirst-i-id");
            console.log(fileItemId);
            fetch(`/newFileDataItem`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    // 'X-CSRF-TOKEN':csrf
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
                    let divFile = document.createElement("div");
                    divFile.className = "file-box-title";
                    file.appendChild(divFile);
                    let aFile = document.createElement("a");
                    aFile.setAttribute("target", "blank");
                    divFile.appendChild(aFile);
                    let iconFile = document.createElement("i");
                    iconFile.className = "bi bi-eye open-eye";
                    iconFile.setAttribute("data-id", `${data.id}`);
                    iconFile.addEventListener('click',(e) =>showCnntact(e))
                    let spanFile = document.createElement("span");
                    aFile.appendChild(iconFile);
                    aFile.appendChild(spanFile);
                    newRow.appendChild(file);
                    // Insert the new row after general_element
                    firtstTr.insertAdjacentElement("afterend", newRow);
                    firtstTr.remove();
                    ///contact js--ic
                    const openEye = document.querySelectorAll(".open-eye");
                    openEye.forEach((el) =>
                        el.addEventListener("click", (e) => {
                            let table_id = e.target.getAttribute("data-id");
                            let table_name = e.target
                                .closest(".table")
                                .getAttribute("data-table-name");
                            console.log(e.target);
                            let dataObj = {
                                table_name: table_name,
                                table_id: table_id,
                            };
                            postDataRelation(dataObj, "fetchContactPost");
                        })
                    );
                });
            // } else {
            //     console.log("Действие отменено.");
            // }
        });
    });
}
checkButtons();

///colorText side
// let elementsWithClass = document.getElementsByClassName("koko");
// console.log("elementsWithClass",elementsWithClass);

// function scrollToElement(index) {
//     if (index < elementsWithClass.length) {
//         elementsWithClass[index].scrollIntoView({ behavior: "smooth" });

//         setTimeout(function () {
//             scrollToElement(index + 1);
//         }, 1000);
//     }
// }

// scrollToElement(0);

//***/// *scroll text parent el/done+
let divElements = document.querySelectorAll(".td-scroll");
divElements.forEach(function (div) {
    let pElementAll = div.querySelectorAll(".centered-text");
    pElementAll.forEach(function (el) {
        let containerMidpoint = div.clientHeight / 2;
        let elementMidpoint = el.clientHeight / 2;
        div.scrollTop = el.offsetTop - containerMidpoint + elementMidpoint;
    });
});

//back icon
// let backIcon = document.querySelectorAll(".backIcon");
function backIconFunc() {
    let backIcon = document.querySelectorAll(".backIcon");
    backIcon.forEach(function (back) {
        back.addEventListener("click", function () {
            // let isConfirmed = confirm("Ետ վերադառն՞ալ");
            // if (isConfirmed) {
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

                    console.log(document.querySelectorAll(".backicon"), 8888);
                    console.log(data);
                    console.log(data.editable);
                    console.log(typeof data.address);
                    console.log("childId", childId);

                    const childrens = data.child;
                    const parent_element = document.getElementById(childId);
                    console.log("parent_element", parent_element);
                    const newTr = document.createElement("tr");
                    newTr.id = `${parentId}`;
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
                    iconElement.setAttribute("dataFirst-i-id", `${parentId}`);
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
                    firstName.setAttribute(
                        "contenteditable",
                        `${data.editable}`
                    );
                    firstName.setAttribute("spellcheck", "false");
                    firstName.setAttribute("data-item-id", `${data.id}`);
                    firstName.setAttribute("data-column", "name");
                    firstName.setAttribute("onclick", "makeEditable(this)");
                    if (data.name !== null) {
                        firstName.textContent = data.name;
                    } else {
                        firstName.textContent = "";
                    }
                    newTr.appendChild(firstName);
                    ////////lastName
                    const lastName = document.createElement("td");
                    lastName.setAttribute(
                        "contenteditable",
                        `${data.editable}`
                    );
                    lastName.setAttribute("spellcheck", "false");
                    lastName.setAttribute("data-item-id", `${data.id}`);
                    lastName.setAttribute("data-column", "surname");
                    lastName.setAttribute("onclick", "makeEditable(this)");
                    if (data.surname !== null) {
                        lastName.textContent = data.surname;
                    } else {
                        lastName.textContent = "";
                    }
                    newTr.appendChild(lastName);
                    // ///////middle_name
                    const middleName = document.createElement("td");
                    middleName.setAttribute(
                        "contenteditable",
                        `${data.editable}`
                    );
                    middleName.setAttribute("spellcheck", "false");
                    middleName.setAttribute("data-item-id", `${data.id}`);
                    middleName.setAttribute("data-column", "patronymic");
                    middleName.setAttribute("onclick", "makeEditable(this)");
                    if (data.patronymic !== null) {
                        middleName.textContent = data.patronymic;
                    } else {
                        middleName.textContent = "";
                    }
                    newTr.appendChild(middleName);
                    ////////// Create a <td> for el.man.birth_year
                    const birthYearCell = document.createElement("td");
                    birthYearCell.setAttribute("spellcheck", "false");
                    birthYearCell.setAttribute("data-item-id", `${data.id}`);
                    birthYearCell.setAttribute("data-column", "birthday");
                    birthYearCell.textContent = data.birth_year;
                    newTr.appendChild(birthYearCell);

                    // Create a <td> with "address"//address
                    const address = document.createElement("td");
                    address.setAttribute("spellcheck", "false");
                    address.setAttribute("data-item-id", `${data.id}`);
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
                    // //file
                    const file = document.createElement("td");
                    let divFile = document.createElement("div");
                    divFile.classList.add("file-box-title");
                    if (!data.editable) {
                        let aElement = document.createElement("a");
                        aElement.target = "_blank";
                        let iElement = document.createElement("i");
                        iElement.className = "bi bi-eye open-eye";
                        iElement.setAttribute("data-id", data.id);
                        iElement.addEventListener('click',(e) =>showCnntact(e))
                        let spanElement = document.createElement("span");
                        aElement.appendChild(iElement);
                        aElement.appendChild(spanElement);
                        divFile.appendChild(aElement);
                    }
                    file.appendChild(divFile);
                    newTr.appendChild(file);
                    // file.textContent = data.real_file_name;
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
                        const checkboxInput = document.createElement("input");
                        checkboxInput.classList.add("form-check-input");
                        checkboxInput.type = "checkbox";
                        checkboxInput.setAttribute(
                            "id",
                            `checkbox${el.man.id}`
                        );
                        checkboxInput.setAttribute(
                            "data-item-id",
                            `${el.man.id}`
                        );
                        checkboxInput.setAttribute(
                            "data-parent-id",
                            `${data.id}`
                        );
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
                        let divFile = document.createElement("div");
                        divFile.classList.add("file-box-title");
                        let aElement = document.createElement("a");
                        aElement.target = "_blank";
                        let iElement = document.createElement("i");
                        iElement.className = "bi bi-eye open-eye";
                        iElement.setAttribute("data-id", el.man.id);
                        iElement.addEventListener('click',(e) =>showCnntact(e))
                        let spanElement = document.createElement("span");
                        aElement.appendChild(iElement);
                        aElement.appendChild(spanElement);
                        divFile.appendChild(aElement);
                        file.appendChild(divFile);
                        newRow.appendChild(file);

                        // Insert the new row after general_element
                        newTr.insertAdjacentElement("afterend", newRow);
                        let checkboxes =
                            document.querySelectorAll(".form-check-input"); //edit cucak check
                        // console.log("checkboxes", checkboxes);
                        checkboxes.forEach(function (checkbox) {
                            checkbox.addEventListener("change", function () {
                                let childId =
                                    checkbox.getAttribute("data-item-id");
                                let parentId =
                                    checkbox.getAttribute("data-parent-id");
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
                    });
                    //back-i iconic check button click
                    checkButtons();
                    parent_element.remove();
                });
            // let backIconArray = Array.from(backIcon);
            // backIconArray = backIconArray.concat(newTr);
            // let updatedBackIcons = document.querySelectorAll(".backIcon");
            // } else {
            //     console.log("bbo");
            // }
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
//---------------------------------- create search block function --------------------------//

const block = document.getElementById("searchBlock");
let left = null;
let test = null;
let right = null;
const allI = document.querySelectorAll(".filter-th i");

allI.forEach((el, idx) => {
    const blockDiv = document.createElement("div");
    let data_type = el.parentElement.getAttribute("data-type");

    // filter-id and filter-complex and filter-complex-date options //
    const filterOptions = [
        {
            key: "Հավասար է",
            value: "=",
        },
        {
            key: "Հավասար չէ",
            value: "!=",
        },
        {
            key: "Մեծ է",
            value: ">",
        },
        {
            key: "Մեծ է կամ հավասար",
            value: ">=",
        },
        {
            key: "Փոքր է",
            value: "<",
        },
        {
            key: "Փոքր է կամ հավասար",
            value: "<=",
        },
    ];

    // standart-complex option //

    const standartComplexOption = [
        {
            key: "Պարունակում է",
            value: "%-%",
        },
        {
            key: "Սկսվում է",
            value: "-%",
        },
        {
            key: "Հավասար է",
            value: "=",
        },
        {
            key: "Հավասար չէ",
            value: "!=",
        },
    ];

    // standart option //

    const standartOption = [
        {
            key: "Պարունակում է",
            value: "%-%",
        },
        {
            key: "Սկսվում է",
            value: "-%",
        },
    ];

    // and or option //

    const queryOption = [
        {
            key: "և",
            value: "and",
        },
        {
            key: "Կամ",
            value: "or",
        },
    ];

    if (data_type === "filter-id") {
        el.setAttribute("data", "filter");
        blockDiv.className = "searchBlock";

        const p = document.createElement("p");
        p.textContent = "Փնտրել նաև";
        blockDiv.appendChild(p);

        const select = document.createElement("select");
        select.className = "searchBlock_section";

        filterOptions.forEach((el) => {
            const option = document.createElement("option");
            option.textContent = el.key;
            option.value = el.value;
            select.appendChild(option);
        });

        blockDiv.appendChild(select);

        const input = document.createElement("input");
        input.type = "number";
        input.min = "0";
        input.placeholder = "search";
        input.className = "searchBlock_input";
        blockDiv.appendChild(input);

        const buttonDiv = document.createElement("div");
        buttonDiv.className = "button_div";

        const searchButton = document.createElement("button");
        searchButton.className = "serch-button";
        searchButton.textContent = "Փնտրել";
        buttonDiv.appendChild(searchButton);

        const delButton = document.createElement("button");
        delButton.className = "delButton";
        delButton.textContent = "Մաքրել";
        buttonDiv.appendChild(delButton);

        blockDiv.appendChild(buttonDiv);

        el.parentElement.appendChild(blockDiv);
    } else if (data_type === "standart") {
        el.setAttribute("data", "filter");
        blockDiv.className = "searchBlock";

        const p = document.createElement("p");
        p.textContent = "Փնտրել նաև";
        blockDiv.appendChild(p);

        const select = document.createElement("select");
        select.className = "searchBlock_section";

        standartOption.forEach((el) => {
            const option = document.createElement("option");
            option.textContent = el.key;
            option.value = el.value;
            select.appendChild(option);
        });

        blockDiv.appendChild(select);

        const input = document.createElement("input");
        input.type = "text";
        input.placeholder = "search";
        input.className = "searchBlock_input";
        blockDiv.appendChild(input);

        const buttonDiv = document.createElement("div");
        buttonDiv.className = "button_div";

        const searchButton = document.createElement("button");
        searchButton.className = "serch-button";
        searchButton.textContent = "Փնտրել";
        buttonDiv.appendChild(searchButton);

        const delButton = document.createElement("button");
        delButton.className = "delButton";
        delButton.textContent = "Մաքրել";
        buttonDiv.appendChild(delButton);

        blockDiv.appendChild(buttonDiv);

        el.parentElement.appendChild(blockDiv);
    } else if (data_type === "standart-complex") {
        el.setAttribute("data", "filter");
        blockDiv.className = "searchBlock";
        const p = document.createElement("p");
        p.textContent = "Փնտրել նաև";
        blockDiv.appendChild(p);

        const select = document.createElement("select");
        select.className = "searchBlock_section";

        standartComplexOption.forEach((el) => {
            const option = document.createElement("option");
            option.textContent = el.key;
            option.value = el.value;
            select.appendChild(option);
        });

        blockDiv.appendChild(select);

        const input = document.createElement("input");
        input.type = "text";
        input.placeholder = "search";
        input.className = "searchBlock_input";
        blockDiv.appendChild(input);

        const buttonDiv = document.createElement("div");
        buttonDiv.className = "button_div";

        const searchButton = document.createElement("button");
        searchButton.className = "serch-button";
        searchButton.textContent = "Փնտրել";
        buttonDiv.appendChild(searchButton);

        const delButton = document.createElement("button");
        delButton.className = "delButton";
        delButton.textContent = "Մաքրել";
        buttonDiv.appendChild(delButton);

        blockDiv.appendChild(buttonDiv);

        el.parentElement.appendChild(blockDiv);
    } else if (data_type === "filter-complex") {
        el.setAttribute("data", "filter");
        el.setAttribute("aria-complex", "true");
        blockDiv.className = "searchBlock";
        const p = document.createElement("p");
        p.textContent = "Փնտրել նաև";
        blockDiv.appendChild(p);

        const select = document.createElement("select");
        select.className = "searchBlock_section";

        filterOptions.forEach((el) => {
            const option = document.createElement("option");
            option.textContent = el.key;
            option.value = el.value;
            select.appendChild(option);
        });

        blockDiv.appendChild(select);

        const input = document.createElement("input");
        input.type = "number";
        input.min = "0";
        input.placeholder = "search";
        input.className = "searchBlock_input";
        blockDiv.appendChild(input);

        const div = document.createElement("div");
        div.className = "and-or-block";
        const select2 = document.createElement("select");
        select2.className = "searchBlock_section-andOr";
        queryOption.forEach((el) => {
            const option = document.createElement("option");
            option.textContent = el.key;
            option.value = el.value;
            select2.appendChild(option);
        });
        div.appendChild(select2);
        blockDiv.appendChild(div);

        const select3 = document.createElement("select");
        select3.className = "searchBlock_section";

        filterOptions.forEach((el) => {
            const option = document.createElement("option");
            option.textContent = el.key;
            option.value = el.value;
            select3.appendChild(option);
        });

        blockDiv.appendChild(select3);

        const input2 = document.createElement("input");
        input2.type = "number";
        input2.className = "searchBlock_input";
        blockDiv.appendChild(input2);

        const buttonDiv = document.createElement("div");
        buttonDiv.className = "button_div";

        const searchButton = document.createElement("button");
        searchButton.className = "serch-button";
        searchButton.textContent = "Փնտրել";
        buttonDiv.appendChild(searchButton);

        const delButton = document.createElement("button");
        delButton.className = "delButton";
        delButton.textContent = "Մաքրել";
        buttonDiv.appendChild(delButton);

        blockDiv.appendChild(buttonDiv);

        el.parentElement.appendChild(blockDiv);
    } else if (data_type === "filter-complex-date") {
        el.setAttribute("data", "filter");
        el.setAttribute("aria-complex", "true");
        blockDiv.className = "searchBlock";
        const p = document.createElement("p");
        p.textContent = "Փնտրել նաև";
        blockDiv.appendChild(p);

        const select = document.createElement("select");
        select.className = "searchBlock_section";

        filterOptions.forEach((el) => {
            const option = document.createElement("option");
            option.textContent = el.key;
            option.value = el.value;
            select.appendChild(option);
        });

        blockDiv.appendChild(select);

        const input = document.createElement("input");
        input.type = "date";
        input.className = "searchBlock_input";
        blockDiv.appendChild(input);

        const div = document.createElement("div");
        div.className = "and-or-block";
        const select2 = document.createElement("select");
        select2.className = "searchBlock_section-andOr";
        queryOption.forEach((el) => {
            const option = document.createElement("option");
            option.textContent = el.key;
            option.value = el.value;
            select2.appendChild(option);
        });
        div.appendChild(select2);
        blockDiv.appendChild(div);

        const select3 = document.createElement("select");
        select3.className = "searchBlock_section";

        filterOptions.forEach((el) => {
            const option = document.createElement("option");
            option.textContent = el.key;
            option.value = el.value;
            select3.appendChild(option);
        });

        blockDiv.appendChild(select3);

        const input2 = document.createElement("input");
        input2.type = "date";
        input2.style.display = "block";
        input2.className = "searchBlock_input";
        blockDiv.appendChild(input2);

        const buttonDiv = document.createElement("div");
        buttonDiv.className = "button_div";

        const searchButton = document.createElement("button");
        searchButton.className = "serch-button";
        searchButton.textContent = "Փնտրել";
        buttonDiv.appendChild(searchButton);

        const delButton = document.createElement("button");
        delButton.className = "delButton";
        delButton.textContent = "Մաքրել";
        buttonDiv.appendChild(delButton);

        blockDiv.appendChild(buttonDiv);

        el.parentElement.appendChild(blockDiv);
    } else if (data_type === "standart-complex-number") {
        el.setAttribute("data", "filter");
        blockDiv.className = "searchBlock";
        const p = document.createElement("p");
        p.textContent = "Փնտրել նաև";
        blockDiv.appendChild(p);

        const select = document.createElement("select");
        select.className = "searchBlock_section";

        standartComplexOption.forEach((el) => {
            const option = document.createElement("option");
            option.textContent = el.key;
            option.value = el.value;
            select.appendChild(option);
        });

        blockDiv.appendChild(select);

        const input = document.createElement("input");
        input.type = "number";
        input.placeholder = "search";
        input.className = "searchBlock_input";
        blockDiv.appendChild(input);

        const buttonDiv = document.createElement("div");
        buttonDiv.className = "button_div";

        const searchButton = document.createElement("button");
        searchButton.className = "serch-button";
        searchButton.textContent = "Փնտրել";
        buttonDiv.appendChild(searchButton);

        const delButton = document.createElement("button");
        delButton.className = "delButton";
        delButton.textContent = "Մաքրել";
        buttonDiv.appendChild(delButton);

        blockDiv.appendChild(buttonDiv);

        el.parentElement.appendChild(blockDiv);
    }

    el.addEventListener("click", (e) => {
        remove_broomstick_filter_element();

        const filterBlock = e.target;
        const rect = filterBlock.getBoundingClientRect();
        right = rect.right;
        let th = el.parentElement.getBoundingClientRect();
        let top = th.top + th.height;
        let card = document.querySelector(".card-body");
        let cardWidth = card.getBoundingClientRect();

        if (cardWidth.width > right + 200) {
            if (
                blockDiv.style.display === "" ||
                blockDiv.style.display === "none"
            ) {
                blockDiv.style.display = "flex";
                blockDiv.style.opacity = "1";
                blockDiv.style.visibility = "visible";
                blockDiv.style.top = top + "px";
                blockDiv.style.left = right + "px";
            } else {
                blockDiv.style.display = "none";
                blockDiv.style.opacity = "0";
                blockDiv.style.visibility = "hidden";
            }
        } else {
            if (
                blockDiv.style.display === "" ||
                blockDiv.style.display === "none"
            ) {
                blockDiv.style.display = "flex";
                blockDiv.style.opacity = "1";
                blockDiv.style.visibility = "visible";
                blockDiv.style.top = top + "px";
                blockDiv.style.left = cardWidth.width - 140 + "px";
            } else {
                blockDiv.style.display = "none";
                blockDiv.style.opacity = "0";
                blockDiv.style.visibility = "hidden";
            }
        }
        window.addEventListener("click", (e) => {
            if (
                blockDiv.style.display === "flex" &&
                e.target.getAttribute("data") !== "filter"
            ) {
                blockDiv.style.display = "none";
                blockDiv.style.opacity = "0";
                blockDiv.style.visibility = "hidden";
            }
        });
        searchBlocks.forEach((el) => {
            el.addEventListener("click", (e) => {
                e.stopPropagation();
            });
        });
    });
});

const searchBlocks = document.querySelectorAll(".searchBlock");

function remove_broomstick_filter_element() {
    searchBlocks.forEach((element) => {
        element.style.display = "none";
    });
}

allI.forEach((el) => {
    el.addEventListener("click", (e) => {
        e.stopPropagation();
    });
});

const searchBtn = document.querySelectorAll(".serch-button");

let th = document.querySelectorAll(".filter-th");
function sort(el) {
    let activeTh = el;
    th.forEach((el) => {
        if (
            el.getAttribute("data-sort") !== "null" &&
            el.innerText !== activeTh.innerText
        ) {
            el.setAttribute("data-sort", "null");
            el.firstChild.remove();
            return false;
        }
    });

    const ascIcon = document.createElement("i");
    ascIcon.className = "bi bi-caret-up-fill";
    const descIcon = document.createElement("i");
    descIcon.className = "bi bi-caret-down-fill";
    el.getAttribute("data-sort") === "null"
        ? el.setAttribute("data-sort", "asc")
        : el.getAttribute("data-sort") === "asc"
        ? el.setAttribute("data-sort", "desc")
        : el.setAttribute("data-sort", "null");
    if (el.getAttribute("data-sort") === "asc") {
        el.insertBefore(ascIcon, el.firstChild);
    } else if (el.getAttribute("data-sort") === "desc") {
        el.firstChild.remove();
        el.insertBefore(descIcon, el.firstChild);
    } else {
        el.firstChild.remove();
    }
    page = 1;
    searchFetch();
}
////----close asc desc icon function----/////
// th.forEach((el) => {
//     el.addEventListener("click", () => sort(el));
// });

function searchFetch(parent) {
    let data = [];
    let dataObj = {};
    let parentObj = {};
    let actions = [];
    // console.log("allI",allI);
    allI.forEach((el, idx) => {
        let field_name = el.getAttribute("data-field-name");
        let searchBlockItem = el.parentElement.querySelector(".searchBlock");
        let selectblockChildren = searchBlockItem.children;
        if (
            el.hasAttribute("aria-complex") &&
            selectblockChildren[2].value !== "" &&
            selectblockChildren[5].value !== ""
        ) {
            parentObj = {
                name: field_name,
                sort: el.parentElement.getAttribute("data-sort"),
                actions: [
                    {
                        action: selectblockChildren[1].value,
                        value: selectblockChildren[2].value,
                    },
                    {
                        query: selectblockChildren[3].childNodes[0].value,
                    },
                    {
                        action: selectblockChildren[4].value,
                        value: selectblockChildren[5].value,
                    },
                ],
                table_name: tb_name,
                section_name: sc_name,
            };
            // data.push(parentObj);
            dataObj[field_name] = parentObj;
            parentObj = {};
            actions = [];
        } else {
            if (searchBlockItem && selectblockChildren[2].value !== "") {
                parentObj = {
                    // name: field_name,
                    sort: el.parentElement.getAttribute("data-sort"),
                    actions: [
                        {
                            action: selectblockChildren[1].value,
                            value: selectblockChildren[2].value,
                        },
                    ],
                    // table_name: tb_name,
                    // section_name: sc_name,
                };
                // data.push(parentObj);
                dataObj[field_name] = parentObj;
                parentObj = {};
                actions = [];
            }
        }
        if (
            (searchBlockItem && selectblockChildren[2].value === "") ||
            (el.hasAttribute("aria-complex") &&
                selectblockChildren[2].value === "" &&
                selectblockChildren[5].value === "")
        ) {
            parentObj = {
                // name: field_name,
                sort: el.parentElement.getAttribute("data-sort"),
                // table_name: tb_name,
                // section_name: sc_name,
            };
            // alert(field_name, 88888)

            dataObj[field_name] = parentObj;
            // data.push(parentObj);
            parentObj = {};
        }
    });
    // fetch post Function //
    // console.log(dataObj);
    let fileNameEl = document.getElementById("file-name");
    let fileName = fileNameEl.getAttribute("data-file-name");
    fetch("/" + lang + `/searchFilter/${fileName}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            // 'X-CSRF-TOKEN':csrf
        },
        body: JSON.stringify(dataObj),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data, "data");
            ///---change count --/////
            const count = document.querySelector(".card-title")
            console.log("count",count);
            count.innerHTML = "Գտնված անձինք"+ " -"+" " +data.count
            ///---remove tbody---///
            const tbody_all = document.getElementById("tbody_elements");
            tbody_all.remove();
            ///---create new tbody---////
            const newTbody = document.createElement("tbody");
            newTbody.classList.add("tbody_elements");
            newTbody.id = "tbody_elements";
            ///----foreach data---///
            data.data.forEach((el) => {
                const newTbodyTr = document.createElement("tr");
                newTbodyTr.id = `${el.id}`;
                newTbodyTr.classList.add("start");
                newTbodyTr.classList.add(`dataFirst-item-id-${el.id}`);
                newTbodyTr.setAttribute("datafirst-item-id", `${el.id}`);
                if (!el.editable) {
                    newTbodyTr.style.backgroundColor = "rgb(195, 194, 194)";
                }
                ///---newTr to newTbody--///
                newTbody.appendChild(newTbodyTr);

                ////---create td elements ---///
                ///icons
                const icons = document.createElement("td");
                icons.setAttribute("scope", "row");
                icons.classList.add("td-icon");
                ///icon div
                let divIcon = document.createElement("div");
                divIcon.className = "td_div_icons";
                /////////icon black//
                let iconElement = document.createElement("i");
                iconElement.className =
                    "bi icon icon-y icon-base bi-check check_btn";
                iconElement.id = "check_btn";
                if (!el.editable) {
                    iconElement.style = `
              color: green;
              pointer-events: none
          `;
                }
                iconElement.setAttribute("dataFirst-i-id", `${el.id}`);
                divIcon.appendChild(iconElement);
                ///back icon
                let backIcon = document.createElement("i");
                if (el.selectedStatus == "like") {
                    backIcon.className =
                        "bi bi-arrow-counterclockwise backIcon";
                    backIcon.setAttribute("dataBackIcon-parent-id", `${el.id}`);
                    // backIcon.setAttribute("dataBackIcon-child-id", `${dataID.manId}`);
                    backIcon.id = "backIcon";
                }
                divIcon.appendChild(backIcon);
                icons.appendChild(divIcon);
                newTbodyTr.appendChild(icons);
                //id
                const idd = document.createElement("td");
                idd.setAttribute("scope", "row");
                if (!el.editable) {
                    idd.textContent = el.id;
                }
                newTbodyTr.appendChild(idd);
                /////status
                const status = document.createElement("td");
                status.setAttribute("scope", "row");
                status.textContent = el.status;
                newTbodyTr.appendChild(status);
                /////procent
                const procent = document.createElement("td");
                procent.setAttribute("scope", "row");
                procent.classList.add("td-icon");
                if (el.procent) {
                    procent.textContent = el.procent + "%";
                } else {
                    ("");
                }
                newTbodyTr.appendChild(procent);
                //////firstName
                const firstName = document.createElement("td");
                firstName.setAttribute("contenteditable", el.editable);
                firstName.setAttribute("spellcheck", "false");
                firstName.setAttribute("data-item-id", `${el.id}`);
                firstName.setAttribute("data-column", "name");
                if (el.editable) {
                    firstName.setAttribute("onclick", "makeEditable(this)");
                }
                if (el.first_name || el.name) {
                    firstName.textContent = el.first_name
                        ? el.first_name.first_name
                        : el.name;
                }
                newTbodyTr.appendChild(firstName);
                ////////lastName
                const lastName = document.createElement("td");
                lastName.setAttribute("contenteditable", el.editable);
                lastName.setAttribute("spellcheck", "false");
                lastName.setAttribute("data-item-id", `${el.id}`);
                lastName.setAttribute("data-column", "surname");
                if (el.editable) {
                    lastName.setAttribute("onclick", "makeEditable(this)");
                }
                if (el.last_name || el.surname) {
                    lastName.textContent = el.last_name
                        ? el.last_name.last_name
                        : el.surname;
                }
                newTbodyTr.appendChild(lastName);
                ///////middle_name
                const middleName = document.createElement("td");
                middleName.setAttribute("contenteditable", el.editable);
                middleName.setAttribute("spellcheck", "false");
                middleName.setAttribute("data-item-id", `${el.id}`);
                middleName.setAttribute("data-column", "patronymic");
                if (el.editable) {
                    middleName.setAttribute("onclick", "makeEditable(this)");
                }
                if (el.middle_name || el.patronymic) {
                    middleName.textContent = el.middle_name
                        ? el.middle_name.middle_name
                        : el.patronymic;
                }
                newTbodyTr.appendChild(middleName);
                //////// birth_year
                const birthYearCell = document.createElement("td");
                birthYearCell.setAttribute("contenteditable", el.editable);
                birthYearCell.setAttribute("spellcheck", "false");
                birthYearCell.setAttribute("data-item-id", `${el.id}`);
                birthYearCell.setAttribute("data-column", "birthday");
                if (el.editable) {
                    birthYearCell.setAttribute("onclick", "makeEditable(this)");
                }
                birthYearCell.textContent = el.birthday;
                newTbodyTr.appendChild(birthYearCell);
                ////address
                const address = document.createElement("td");
                address.setAttribute("spellcheck", "false");
                address.setAttribute("data-item-id", `${el.id}`);
                address.setAttribute("data-column", "address");
                address.classList.add("td_par_address");
                if (typeof el.address !== "object") {
                    let addressDiv = document.createElement("div");
                    addressDiv.style.cssText =
                        "text-wrap: balance; overflow-y: auto; max-height: 130px; line-height: 20px;";
                    addressDiv.textContent = el.address;
                    address.appendChild(addressDiv);
                }
                newTbodyTr.appendChild(address);
                // //description
                const desc = document.createElement("td");
                desc.className = "td-lg td-scroll-wrapper";
                let divElement = document.createElement("div");
                divElement.classList.add("td-scroll");
                if (el.paragraph) {
                    divElement.innerHTML = el.paragraph;
                }
                desc.appendChild(divElement);
                newTbodyTr.appendChild(desc);
                // //file
                const file = document.createElement("td");
                let divFile = document.createElement("div");
                divFile.classList.add("file-box-title");
                if (!el.editable) {
                    let aElement = document.createElement("a");
                    aElement.target = "_blank";
                    let iElement = document.createElement("i");
                    iElement.className = "bi bi-eye open-eye";
                    iElement.setAttribute("data-id", el.id);
                    iElement.addEventListener('click',(e) =>showCnntact(e))
                    let spanElement = document.createElement("span");
                    aElement.appendChild(iElement);
                    aElement.appendChild(spanElement);
                    divFile.appendChild(aElement);
                }
                file.appendChild(divFile);
                newTbodyTr.appendChild(file);

                el.child?.forEach((child) => {
                    console.log("child", child);
                    console.log("child id", child.man.id);
                    console.log("el.id", el.id);
                    // Create a new tr for childrens
                    const newRow = document.createElement("tr");
                    newRow.classList.add(`child_items-${el.id}`);
                    /////////checkbox
                    const checkbox = document.createElement("td");
                    checkbox.setAttribute("scope", "row");
                    checkbox.classList.add("td-icon");
                    const div = document.createElement("div");
                    // div.style.textAlign = "center";
                    div.classList.add("form-check");
                    div.classList.add("icon");
                    div.classList.add("icon-sm");
                    const checkboxInput = document.createElement("input");
                    checkboxInput.classList.add("form-check-input");
                    checkboxInput.type = "checkbox";
                    checkboxInput.setAttribute("id", `checkbox${child.man.id}`);
                    checkboxInput.setAttribute(
                        "data-item-id",
                        `${child.man.id}`
                    );
                    checkboxInput.setAttribute("data-parent-id", `${el.id}`);
                    div.appendChild(checkboxInput);
                    checkbox.appendChild(div);
                    newRow.appendChild(checkbox);
                    //id
                    const idd = document.createElement("td");
                    idd.setAttribute("scope", "row");
                    idd.textContent = child.man.id;
                    newRow.appendChild(idd);
                    /////row
                    const row = document.createElement("td");
                    row.setAttribute("scope", "row");
                    if (child.man.errorMessage === "Սխալ ծննդյան ֆորմատ") {
                        const pRow = document.createElement("p");
                        pRow.style.cssText =
                            "color:red; overflow-y: clip; text-overflow: ellipsis";
                        pRow.textContent = "Սխալ ծննդյան ֆորմատ";
                    }
                    newRow.appendChild(row);
                    //////procent
                    const procent = document.createElement("td");
                    procent.textContent = child.procent.toString().slice(0, 5);
                    procent.classList.add("td-icon");
                    procent.setAttribute("scope", "row");
                    newRow.appendChild(procent);
                    //////firstName
                    const firstName = document.createElement("td");
                    firstName.setAttribute("spellcheck", "false");
                    if (child.man.first_name1) {
                        firstName.textContent =
                            child.man.first_name1[0].first_name;
                    } else {
                        firstName.textContent = "";
                    }
                    newRow.appendChild(firstName);
                    ////////lastName
                    const lastName = document.createElement("td");
                    lastName.setAttribute("spellcheck", "false");
                    if (child.man.last_name1 !== null) {
                        lastName.textContent =
                            child.man.last_name1[0].last_name;
                    } else {
                        lastName.textContent = "";
                    }
                    newRow.appendChild(lastName);
                    ///////middle_name
                    const middleName = document.createElement("td");
                    middleName.setAttribute("contenteditable", "true");
                    middleName.setAttribute("spellcheck", "false");
                    if (child.man.middle_name1 !== null) {
                        middleName.textContent =
                            child.man.middle_name1[0].middle_name;
                    } else {
                        middleName.textContent = "";
                    }
                    newRow.appendChild(middleName);
                    ////////birth_year
                    const birthYearCell = document.createElement("td");
                    birthYearCell.setAttribute("spellcheck", "false");
                    let backgroundColor =
                        child.man.errorMessage === "Սխալ ծննդյան ֆորմատ"
                            ? "red"
                            : "white";
                    birthYearCell.style.backgroundColor = backgroundColor;
                    if (child.man.birthday_str !== null) {
                        birthYearCell.textContent =
                            child.man.birthday || child.man.birthday_str;
                    }
                    newRow.appendChild(birthYearCell);
                    ////address
                    const address = document.createElement("td");
                    address.setAttribute("spellcheck", "false");
                    address.textContent = "";
                    newRow.appendChild(address);
                    //description
                    const desc = document.createElement("td");
                    desc.className = "td-lg td-scroll-wrapper";
                    const divDesc = document.createElement("div");
                    divDesc.classList.add("td-scroll");
                    desc.appendChild(divDesc);
                    newRow.appendChild(desc);
                    //file
                    const file = document.createElement("td");
                    let divFile = document.createElement("div");
                    divFile.classList.add("file-box-title");
                    let aElement = document.createElement("a");
                    aElement.target = "_blank";
                    let iElement = document.createElement("i");
                    iElement.className = "bi bi-eye open-eye";
                    iElement.setAttribute("data-id", child.man.id);
                    iElement.addEventListener('click',(e) =>showCnntact(e))
                    let spanElement = document.createElement("span");
                    aElement.appendChild(iElement);
                    aElement.appendChild(spanElement);
                    divFile.appendChild(aElement);
                    file.appendChild(divFile);
                    newRow.appendChild(file);
                    newTbodyTr.insertAdjacentElement("afterend", newRow);
                });
            });
            ////----tbody to thead---////
            const thead_all = document.getElementById("thead_elements");
            thead_all.insertAdjacentElement("afterend", newTbody);
            ///----icon checky sksuma ashxatel--///
            checkButtons();
            //***/// *scroll text parent el/done+
            let divElements = document.querySelectorAll(".td-scroll");
            divElements.forEach(function (div) {
                let pElementAll = div.querySelectorAll(".centered-text");
                pElementAll.forEach(function (el) {
                    let containerMidpoint = div.clientHeight / 2;
                    let elementMidpoint = el.clientHeight / 2;
                    div.scrollTop =
                        el.offsetTop - containerMidpoint + elementMidpoint;
                });
            });
            ////----checkboxy sksuma shxatel stexic heto---///////
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
        })
        .catch((error) => {
            console.log("Произошла ошибка", error);
        });

    // postData(parentObj, "POST", `/searchFilter/${fileName}`);
}
searchBtn.forEach((el) => {
    el.addEventListener("click", () => {
        page = 1;
        searchFetch(el);
    });
});

// --------------------------- clear buttons serchblock ---------------------------- //

const delButton = document.querySelectorAll(".delButton");

delButton.forEach((el) => {
    el.addEventListener("click", (e) => {
        const parent = el.closest(".searchBlock");
        const SearchBlockSelect = parent.querySelectorAll("select");
        const SearchBlockInput = parent.querySelectorAll("input");

        SearchBlockSelect.forEach((element) => {
            element.selectedIndex = 0;
        });

        SearchBlockInput.forEach((element) => {
            element.value = "";
        });
        page = 1;
        searchFetch(parent);
    });
});

// -------------------------- resiz Function -------------------------------------- //

document.addEventListener("DOMContentLoaded", (e) => {
    onMauseScrolTh();
});

function onMauseScrolTh(e) {
    const createResizableTable = function (table) {
        const cols = table.querySelectorAll("th");
        [].forEach.call(cols, function (col) {
            const resizer = document.createElement("div");
            resizer.classList.add("resizer");
            resizer.style.height = table.offsetHeight + "px";
            col.appendChild(resizer);
            createResizableColumn(col, resizer);
        });
    };
    const createResizableColumn = function (col, resizer) {
        let x = 0;
        let w = 0;
        const mouseDownHandler = function (e) {
            x = e.clientX;
            const styles = window.getComputedStyle(col);
            w = parseInt(styles.width, 10);
            document.addEventListener("mousemove", mouseMoveHandler);
            document.addEventListener("mouseup", mouseUpHandler);
        };

        const mouseMoveHandler = function (e) {
            const dx = e.clientX - x;
            col.style.width = w + dx + "px";
        };

        const mouseUpHandler = function (e) {
            document.removeEventListener("mousemove", mouseMoveHandler);
            document.removeEventListener("mouseup", mouseUpHandler);
        };

        resizer.addEventListener("mousedown", mouseDownHandler);
    };

    createResizableTable(document.querySelector(".resizeMe"));
}

// -------------------------- end resiz Function  -------------------------------------- //

////loader-------
// document.addEventListener('DOMContentLoaded', function () {
//     // Hide loader when the page has finished loading
//     document.getElementById('loader').style.display = "none";
// });
