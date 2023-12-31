// --------------------- fetch post data ----------------- //
let transForm = "none";
async function postDataRelation(propsData, typeAction, rowTitle) {
    const postUrl = "/" + lang + "/get-relations";
    try {
        const response = await fetch(postUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(propsData),
        });

        if (!response.ok) {
            throw new Error("Network response was not ok");
        } else {
            const responseData = await response.json();
            showContactDiv(responseData.data, propsData, typeAction, rowTitle);
        }
    } catch (error) {
        console.error("Error:", error);
    }
}


// --------------------- fetch post end ------------------ //

// =============================================
    // show table data
// =============================================
function showInfo(data,li) {
    let openTable = li.closest("ul").querySelector(".table");
    if (li.getAttribute("check")) {
        openTable?.remove();
        li.removeAttribute("check");
        li
            .querySelector("i")
            .setAttribute("class", "bi bi-caret-down-fill");
    } else {
        openTable?.previousElementSibling
            .querySelector("i")
            .setAttribute("class", "bi bi-caret-down-fill");
        openTable?.previousElementSibling.removeAttribute("check");
        openTable?.remove();
        let elmIndex = li.getAttribute("element-index");
        let openCloseClass = li.children[0]?.className;
        let icon = li.querySelector("i");
        openCloseClass === "bi bi-caret-down-fill"
            ? icon.setAttribute("class", "bi bi-caret-up-fill ")
            : icon.setAttribute("class", "bi bi-caret-down-fill");
        let table = document.createElement("table");
        table.setAttribute("class", "table person_table");
        let tbody = document.createElement("tbody");
        table.appendChild(tbody);
        
        for (let el in data) {
            let fieldKey = el;
            let fieldValue = data[el];
            let tr = document.createElement("tr");
            let tdKey = document.createElement("td");
            tdKey.innerText = fieldKey;
            let tdValue = document.createElement("td");
            fieldValue !== null
                ? (tdValue.innerText = fieldValue)
                : (tdValue.innerText = "");
            tr.append(tdKey, tdValue);
            tbody.appendChild(tr);
        }

        function contactPost() {
            showLoader()
            let table_name =
                this.closest(".table").previousElementSibling.getAttribute(
                    "relation_name"
                );
            let table_id =
                this.closest(".table").previousElementSibling.getAttribute(
                    "relation_id"
                );
            let rowTitle =
                this.closest("tr").querySelectorAll("td")[0].innerText;
            let dataObj = {
                table_name: table_name,
                table_id: table_id,
            };
            postDataRelation(dataObj, "fetchContactPostBtn", rowTitle);
        }

        let buttonContact = document.createElement("span");
        buttonContact.innerText = ties;
        buttonContact.className = "button-contact";

        let tr = document.createElement("tr");
        let tdKey = document.createElement("td");
        let tdValue = document.createElement("td");
        tdValue.style.textAlign = "center";
        tdKey.innerText = li.innerText;
        tdValue.appendChild(buttonContact);
        tr.append(tdKey, tdValue);
        tbody.appendChild(tr);

        li.insertAdjacentElement("afterend", table);
        li.setAttribute("check", "true");
    }

    let contactButtons = document.querySelectorAll(".button-contact");

    contactButtons.forEach((el) =>
        el.addEventListener("click",contactPost)
    );
}
// =============================================
    // show table data end
// =============================================

// ==============================================
   // fetch relation table
// ==============================================
async function postRelationTable(propsData,li) {
    const postUrl = "/" + lang + "/get-single-relation";
    try {
        const response = await fetch(postUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(propsData),
        });

        if (!response.ok) {
            throw new Error("Network response was not ok");
        } else {
            const responseData = await response.json();
            let data = responseData.data[0].fields
            showInfo(data,li)
        }
    } catch (error) {
        console.error("Error:", error);
    }
}
// ==============================================
   // fetch relation table end
// ==============================================

// --------------------- contact js ---------------------- //


const openEye = document.querySelectorAll(".open-eye");

function showContactDiv(data, props, typeAction, rowTitle) {
    let loader = document.body.querySelector('#loader-wrapper')
    loader?.remove()
    if (!Array.isArray(data)) {
        data = Object.values(data).map((obj) => obj);
    }

    let testDiv = document.querySelector(".contact_block");
    if (testDiv && typeAction === "fetchContactPost") {
        testDiv.remove();
    }

    let buttonClassArr = [
        "bi bi-dash-lg",
        "bi bi-arrows-fullscreen",
        "bi bi-x-lg",
    ];
    let buttonIdArr = [
        "bi bi-dash-lg minimizeBtn",
        "bi bi-arrows-fullscreen maximizeBtn",
        "bi bi-x-lg closeBtn",
    ];

    let contactBlock = document.createElement("div");
    contactBlock.className = "resizer_contact contact_block";
    Math.floor(window.scrollY) < 52
        ? (contactBlock.style.top = "52px")
        : (contactBlock.style.top = Math.floor(window.scrollY) + 20 + "px");

    let minMaxCloseBlockDiv = document.createElement("div");
    minMaxCloseBlockDiv.className = "minMaxClose-block";

    let buttonBlock = document.createElement("div");
    buttonBlock.className = "button-block";

    for (let i = 0; i < buttonClassArr.length; i++) {
        let icon = document.createElement("i");
        icon.className = buttonIdArr[i];
        buttonBlock.appendChild(icon);
    }
    buttonBlock.addEventListener("click", (e) => {
        e.preventDefault();
    });
    let contentDiv = document.createElement("div");
    contentDiv.className = "content";
    minMaxCloseBlockDiv.appendChild(buttonBlock);

    let ul = document.createElement("ul");
    for (let i = 0; i < data.length; i++) {
        let li = document.createElement("li");
        li.setAttribute("element-index", i);
        li.innerText = `${data[i].relation_name_translation} : id = ${data[i].relation_id}`;
        li.setAttribute("relation_name", data[i].relation_name);
        li.setAttribute("relation_id", data[i].relation_id);
        let iconFill = document.createElement("i");
        iconFill.className = "bi bi-caret-down-fill";
        li.appendChild(iconFill);
        ul.appendChild(li);
    }

    contentDiv.appendChild(ul);
    contactBlock.append(minMaxCloseBlockDiv, contentDiv);
    document.body.appendChild(contactBlock);

    let minimizeBtn = document.querySelectorAll(".minimizeBtn");
    let maximizeBtn = document.querySelectorAll(".maximizeBtn");
    let h3 = document.createElement("h3");
    if (typeAction == "fetchContactPostBtn") {
        h3.innerText = rowTitle;
    } else {
        h3.innerText = `${parent_table_name}  , ${ties}: id = ${props.table_id}`;
    }
    h3.style.fontSize = "16px";
    h3.style.display = "flex";
    minMaxCloseBlockDiv.insertAdjacentElement("afterbegin", h3);
    let closeBtn = document.querySelectorAll(".closeBtn");

    minimizeBtn.forEach((el) =>
        el.addEventListener("click", () => {
            el.closest(".contact_block")
                .querySelector(".content")
                .classList.add("minimized");
            el.closest(".contact_block").classList.remove("maximized");
            el.closest(".contact_block").classList.remove("resizer_contact");
            el.style.display = "none";
            el.closest("div")
                .querySelector(".maximizeBtn")
                .setAttribute("class", "bi bi-fullscreen maximizeBtn");
            el.closest(".contact_block").style.height = "50px";
        })
    );

    maximizeBtn.forEach((el) =>
        el.addEventListener("click", (e) => {
            if (e.target.className === "bi bi-arrows-fullscreen maximizeBtn") {
                setTimeout(() => {
                    window.scrollTo(0, 0);
                }, 0);
                el.closest(".contact_block").classList.add("maximized");
                el.closest(".contact_block")
                    .querySelector(".content")
                    .classList.remove("minimized");
                el.closest("div").querySelector(".minimizeBtn").style.display =
                    "none";
                el.closest(".contact_block").classList.remove(
                    "resizer_contact"
                );
                el.closest("div")
                    .querySelector(".maximizeBtn")
                    .setAttribute("class", "bi bi-fullscreen maximizeBtn");
                el.closest(".contact_block").setAttribute("style", "top:0;");
            } else if (e.target.className === "bi bi-fullscreen maximizeBtn") {
                el.closest(".contact_block").style.height = "600px";
                el.closest(".contact_block").classList.remove("maximized");
                el.closest(".contact_block").classList.add("resizer_contact");
                el.closest(".contact_block")
                    .querySelector(".content")
                    .classList.remove("minimized");
                el.closest("div").querySelector(".minimizeBtn").style.display =
                    "block";
                el.setAttribute("class", "bi bi-arrows-fullscreen maximizeBtn");
            }
        })
    );

    closeBtn.forEach((el) =>
        el.addEventListener("click", () => {
            el.closest(".contact_block").remove();
        })
    );


    let li = document.querySelectorAll(".content ul li");
    function fetchContactTable(el) {
        let relation_name = el.getAttribute('relation_name')
        let relation_id = el.getAttribute('relation_id')
        let obj = {
            table_name: relation_name,
            table_id: relation_id
        }
        postRelationTable(obj,el)
    }

    // li.forEach((el) => el.addEventListener("click", (e) => showInfo(e)));
    li.forEach((el) => el.addEventListener("click", (e) => fetchContactTable(el)));

    const draggableDivs = document.querySelectorAll(".minMaxClose-block");
    let isDragging = false;
    let initialX = 0;
    let initialY = 0;
    let offsetX = 0;
    let offsetY = 0;
    let currentDraggingDiv = null;

    draggableDivs.forEach((div) => {
        div.addEventListener("mousedown", (e) => {
            isDragging = true;
            currentDraggingDiv = div.closest(".contact_block");
            initialX = e.clientX - offsetX;
            initialY = e.clientY - offsetY;
        });

        document.addEventListener("mousemove", drag);
        document.addEventListener("mouseup", stopDrag);
    });

    function drag(e) {
        if (!isDragging) return;
        offsetX = e.clientX - initialX;
        offsetY = e.clientY - initialY;
        currentDraggingDiv.style.transform = `translate(${offsetX}px, ${offsetY}px)`;
        transForm = `translate(${offsetX}px, ${offsetY}px)`;
    }

    function stopDrag() {
        isDragging = false;
    }
}

openEye.forEach((el) => el.addEventListener("click", (e) => showCnntact(e)));
function showCnntact(e) {
    let table_id = e.target.getAttribute("data-id");
    let table_name = e.target.closest(".table").getAttribute("data-table-name");
    if (document.querySelector(".table").classList.contains("notifications-table")) {
        table_name = e.target.getAttribute("data-table-name");
        if(table_name === 'organization') {
            parent_table_name = parent_table_organization;
            fieldName = fieldNameOrganization;
        }

        if(table_name === 'man') {
            parent_table_name = parent_table_man;
            fieldName = fieldNameMan;
        }
    }
    let dataObj = {
        table_name: table_name,
        table_id: table_id,
    };
    showLoader()
    postDataRelation(dataObj, "fetchContactPost");
}

// ---------------------- contact js end ----------------------------------------- //

// ================= Narine =====================
const openRelationFielde = document.querySelectorAll(".open-relation-field");

openRelationFielde.forEach((el) =>
    el.addEventListener("click", (e) => showRelationFielde(e))
);

function showRelationFielde(e) {
    let table_id = e.target.getAttribute("data-id");
    let table_name = e.target.getAttribute("data-table-name");
    let dataObj = {
        table_name: table_name,
        table_id: table_id,
    };
    showLoader()
    postData1(dataObj, "fetchContactPost");
}

async function postData1(propsData, typeAction, rowTitle) {
    const postUrl = "/" + lang + "/get-single-relation";
    try {
        const response = await fetch(postUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(propsData),
        });

        if (!response.ok) {
            throw new Error("Network response was not ok");
        } else {
            const responseData = await response.json();
            showModelFields(responseData.data, propsData, typeAction, rowTitle);
        }
    } catch (error) {
        console.error("Error:", error);
    }
}

function showModelFields(data, props, typeAction, rowTitle) {
    let loader = document.body.querySelector('#loader-wrapper')
    loader?.remove()
    if (!Array.isArray(data)) {
        data = Object.values(data).map((obj) => obj);
    }

    let testDiv = document.querySelector(".contact_block");
    if (testDiv && typeAction === "fetchContactPost") {
        testDiv.remove();
    }

    let buttonClassArr = [
        "bi bi-dash-lg",
        "bi bi-arrows-fullscreen",
        "bi bi-x-lg",
    ];
    let buttonIdArr = [
        "bi bi-dash-lg minimizeBtn",
        "bi bi-arrows-fullscreen maximizeBtn",
        "bi bi-x-lg closeBtn",
    ];

    let contactBlock = document.createElement("div");
    contactBlock.className = "resizer_contact contact_block";
    Math.floor(window.scrollY) < 52
        ? (contactBlock.style.top = "52px")
        : (contactBlock.style.top = Math.floor(window.scrollY) + 20 + "px");

    let minMaxCloseBlockDiv = document.createElement("div");
    minMaxCloseBlockDiv.className = "minMaxClose-block";

    let buttonBlock = document.createElement("div");
    buttonBlock.className = "button-block";

    for (let i = 0; i < buttonClassArr.length; i++) {
        let icon = document.createElement("i");
        icon.className = buttonIdArr[i];
        buttonBlock.appendChild(icon);
    }
    buttonBlock.addEventListener("click", (e) => {
        e.preventDefault();
    });
    let contentDiv = document.createElement("div");
    contentDiv.className = "content";
    minMaxCloseBlockDiv.appendChild(buttonBlock);

    contactBlock.append(minMaxCloseBlockDiv, contentDiv);
    document.body.appendChild(contactBlock);
    let dataInfo = data[0];
    console.log(dataInfo);
    let minimizeBtn = document.querySelectorAll(".minimizeBtn");
    let maximizeBtn = document.querySelectorAll(".maximizeBtn");
    let h3 = document.createElement("h3");

    let title = dataInfo.relation_name_translation + `: id = ${props.table_id}`;
    h3.innerText = title;

    h3.style.fontSize = "16px";
    h3.style.display = "flex";
    minMaxCloseBlockDiv.insertAdjacentElement("afterbegin", h3);
    let closeBtn = document.querySelectorAll(".closeBtn");

    minimizeBtn.forEach((el) =>
        el.addEventListener("click", () => {
            el.closest(".contact_block")
                .querySelector(".content")
                .classList.add("minimized");
            el.closest(".contact_block").classList.remove("maximized");
            el.closest(".contact_block").classList.remove("resizer_contact");
            el.style.display = "none";
            el.closest("div")
                .querySelector(".maximizeBtn")
                .setAttribute("class", "bi bi-fullscreen maximizeBtn");
            el.closest(".contact_block").style.height = "50px";
        })
    );

    maximizeBtn.forEach((el) =>
        el.addEventListener("click", (e) => {
            if (e.target.className === "bi bi-arrows-fullscreen maximizeBtn") {
                setTimeout(() => {
                    window.scrollTo(0, 0);
                }, 0);

                el.closest(".contact_block").classList.add("maximized");
                el.closest(".contact_block")
                    .querySelector(".content")
                    .classList.remove("minimized");
                el.closest("div").querySelector(".minimizeBtn").style.display =
                    "none";
                el.closest(".contact_block").classList.remove(
                    "resizer_contact"
                );
                el.closest("div")
                    .querySelector(".maximizeBtn")
                    .setAttribute("class", "bi bi-fullscreen maximizeBtn");
                el.closest(".contact_block").setAttribute("style", "top:0;");
            } else if (e.target.className === "bi bi-fullscreen maximizeBtn") {
                el.closest(".contact_block").style.height = "600px";
                el.closest(".contact_block").classList.remove("maximized");
                el.closest(".contact_block").classList.add("resizer_contact");
                el.closest(".contact_block")
                    .querySelector(".content")
                    .classList.remove("minimized");
                el.closest("div").querySelector(".minimizeBtn").style.display =
                    "block";
                el.setAttribute("class", "bi bi-arrows-fullscreen maximizeBtn");
            }
        })
    );

    closeBtn.forEach((el) =>
        el.addEventListener("click", () => {
            el.closest(".contact_block").remove();
        })
    );

    let table = document.createElement("table");
    table.setAttribute("class", "table person_table");
    let tbody = document.createElement("tbody");
    let fields = dataInfo.fields;

    for (let el in fields) {
        let fieldKey = el;
        let fieldValue = fields[el];

        let tr = document.createElement("tr");
        let tdKey = document.createElement("td");
        tdKey.innerText = fieldKey;
        let tdValue = document.createElement("td");
        fieldValue !== null
            ? (tdValue.innerText = fieldValue)
            : (tdValue.innerText = "");
        tr.append(tdKey, tdValue);
        tbody.appendChild(tr);
    }
    function contactPost() {
        let table_name = dataInfo.relation_name;
        let table_id = dataInfo.relation_id;
        let rowTitle = this.closest("tr").querySelectorAll("td")[0].innerText;
        let dataObj = {
            table_name: table_name,
            table_id: table_id,
        };
        showLoader()
        postDataRelation(dataObj, "fetchContactPostBtn", rowTitle);
    }

    let buttonContact = document.createElement("span");
    buttonContact.innerText = ties;
    buttonContact.className = "button-contact";

    let tr = document.createElement("tr");
    let tdKey = document.createElement("td");
    let tdValue = document.createElement("td");
    tdValue.style.textAlign = "center";

    tdKey.innerText = title;
    tdValue.appendChild(buttonContact);
    tr.append(tdKey, tdValue);
    tbody.appendChild(tr);

    table.appendChild(tbody);

    contentDiv.appendChild(table);

    let contactButtons = document.querySelectorAll(".button-contact");

    contactButtons.forEach((el) => el.addEventListener("click", contactPost));

    const draggableDivs = document.querySelectorAll(".minMaxClose-block");
    let isDragging = false;
    let initialX = 0;
    let initialY = 0;
    let offsetX = 0;
    let offsetY = 0;
    let currentDraggingDiv = null;

    draggableDivs.forEach((div) => {
        div.addEventListener("mousedown", (e) => {
            isDragging = true;
            currentDraggingDiv = div.closest(".contact_block");
            initialX = e.clientX - offsetX;
            initialY = e.clientY - offsetY;
        });

        document.addEventListener("mousemove", drag);
        document.addEventListener("mouseup", stopDrag);
    });

    function drag(e) {
        if (!isDragging) return;
        offsetX = e.clientX - initialX;
        offsetY = e.clientY - initialY;
        currentDraggingDiv.style.transform = `translate(${offsetX}px, ${offsetY}px)`;
        transForm = `translate(${offsetX}px, ${offsetY}px)`;
    }

    function stopDrag() {
        isDragging = false;
    }
}

function showLoader (){
    let loader_wrapper = document.createElement('div')
    loader_wrapper.id = "loader-wrapper"
    let loader = document.createElement('div')
    loader.id = "loader"
    loader_wrapper.appendChild(loader)
    document.body.appendChild(loader_wrapper)
}
