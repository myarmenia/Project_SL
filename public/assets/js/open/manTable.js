const block = document.getElementById("searchBlock");
const allI = document.querySelectorAll(".filter-th i");
let page = 1;
const perPage = 10;
let lastScrollPosition = 0;
let sc_name = document
    .querySelector(".table")
    ?.getAttribute("data-section-name");
let tb_name = document.querySelector(".table")?.getAttribute("data-table-name");
let man_search_inputs = document.querySelectorAll(
    ".man-search-inputs div .man-search-input"
);
let full_name_input = document.querySelector(".full-name-input");
let id_filter_input = document.querySelector(".id-filter-input");
let search_input_btn = document.querySelector(".search-input-btn");


function printResponsData(responseData) {
    let data = responseData.data;
    let count = document.querySelector(".count_block b");
    count.innerText = responseData.total;

    let table_tbody = document.querySelector(".table").querySelector("tbody");
    if (page == 1) {
        table_tbody.innerHTML = "";
    }

    data.forEach((el) => {
        let obj_keys = Object.keys(el);
        let obj_values = Object.values(el);
        let tr = document.createElement("tr");
        if (el.signal_count > 0) {
            tr.style.backgroundColor = "#f44336d1";
        }
        if (tb_name === "man") {
            for (let i = -2; i <= 34; i++) {
                if (i === -2 && allow_change === true) {
                    let td = document.createElement("td");

                    td.innerHTML = `
                                <a href='/${lang}/${tb_name}/${obj_values[0]}/edit'>
                                    <i class="bi bi-pencil-square open-edit" ></i> </a> `;
                    td.style = `
                        text-align:center;
                        `;
                    let editBtn = document.createElement("i");
                    td.appendChild(editBtn);
                    tr.appendChild(td);
                } else if (i === -1) {
                    let td = document.createElement("td");
                    td.style = `
                        text-align:center;
                        `;
                    let contactBtn = document.createElement("i");
                    contactBtn.setAttribute("class", "bi bi-eye open-eye");
                    contactBtn.setAttribute("data-id", obj_values[0]);

                    // ========= contact js function ============== //

                    contactBtn.onclick = (e) => showCnntact(e);

                    // ========= contact js function end ========= //

                    td.appendChild(contactBtn);
                    tr.appendChild(td);
                } else {
                    if (i < 32) {
                        if (
                            obj_keys[i] !== "signal_count"
                            // &&
                            // obj_keys[i] !== "man_passed_by_signal"
                        ) {
                            let td = document.createElement("td");

                            if (i === 18 && tb_name === "man") {
                                let div = document.createElement("div");
                                div.style = `
                                    white-space: initial;
                                    `;
                                td.style = `
                                    display: block;overflow-x: hidden; overflow-y: auto; height:70px; padding:10px
                                    `;
                                obj_values[i] === "null"
                                    ? (div.innerText = "")
                                    : (div.innerText = obj_values[i]);
                                td.appendChild(div);
                                tr.appendChild(td);
                            } else {
                                obj_values[i] === "null"
                                    ? (td.innerText = "")
                                    : (td.innerText = obj_values[i]);
                                tr.appendChild(td);
                            }
                        }
                    } else if (i === 33 && main_route) {
                        let td = document.createElement("td");
                        td.innerHTML = `
                                <a href='/${lang}/add-relation?main_route=${main_route}&model_id=${model_id}&relation=${relation}&fieldName=${fieldName}&id=${obj_values[0]}'>
                                    <i class="bi bi-plus-square open-add" title="Ավելացնել"></i> </a> `;
                        td.style = `
                        text-align:center;
                        `;
                        tr.appendChild(td);
                    } else if (i === 34 && allow_delete === true) {
                        let td = document.createElement("td");
                        td.style = `
                        text-align:center;
                        `;
                        let del_but = document.createElement("button");
                        del_but.setAttribute("data-id", el.id);

                        del_but.setAttribute(
                            "class",
                            "btn_close_modal my-delete-item"
                        );
                        del_but.setAttribute("data-bs-toggle", "modal");
                        del_but.setAttribute("data-bs-target", "#deleteModal");
                        del_but.setAttribute("data-id", el.id);
                        let deleteBtn = document.createElement("i");
                        deleteBtn.setAttribute(
                            "class",
                            "bi bi-trash3 open-delete"
                        );
                        deleteBtn.addEventListener("click", deleteFuncton);
                        del_but.appendChild(deleteBtn);
                        td.appendChild(del_but);
                        tr.appendChild(td);
                    }
                }
            }
        } else {
            for (let i = -2; i <= obj_keys.length + 1; i++) {
                if (i === -2 && allow_change === true) {
                    let td = document.createElement("td");

                    td.innerHTML = `
                                <a href='/${lang}/${tb_name}/${obj_values[0]}/edit'>
                                    <i class="bi bi-pencil-square open-edit" ></i> </a> `;
                    td.style = `
                        text-align:center;
                        `;
                    let editBtn = document.createElement("i");
                    td.appendChild(editBtn);
                    tr.appendChild(td);
                } else if (i === -1) {
                    let td = document.createElement("td");
                    td.style = `
                        text-align:center;
                        `;
                    let contactBtn = document.createElement("i");
                    contactBtn.setAttribute("class", "bi bi-eye open-eye");
                    contactBtn.setAttribute("data-id", obj_values[0]);

                    // ========= contact js function ============== //

                    contactBtn.onclick = (e) => showCnntact(e);

                    // ========= contact js function end ========= //

                    td.appendChild(contactBtn);
                    tr.appendChild(td);
                } else {
                    if (i < obj_keys.length) {
                        if (
                            obj_keys[i] !== "signal_has_man" &&
                            obj_keys[i] !== "man_passed_by_signal"
                        ) {
                            let td = document.createElement("td");
                            obj_values[i] === "null"
                                ? (td.innerText = "")
                                : (td.innerText = obj_values[i]);
                            tr.appendChild(td);
                        }
                    } else if (i === obj_keys.length && main_route) {
                        let td = document.createElement("td");
                        td.innerHTML = `
                                <a href='/${lang}/add-relation?main_route=${main_route}&model_id=${model_id}&relation=${relation}&fieldName=${fieldName}&id=${obj_values[0]}'>
                                    <i class="bi bi-plus-square open-add" title="Ավելացնել"></i> </a> `;
                        td.style = `
                        text-align:center;
                        `;
                        tr.appendChild(td);
                    } else if (
                        i === obj_keys.length + 1 &&
                        allow_delete === true
                    ) {
                        let td = document.createElement("td");
                        td.style = `
                        text-align:center;
                        `;
                        let del_but = document.createElement("button");
                        del_but.setAttribute("data-id", el.id);

                        del_but.setAttribute(
                            "class",
                            "btn_close_modal my-delete-item"
                        );
                        del_but.setAttribute("data-bs-toggle", "modal");
                        del_but.setAttribute("data-bs-target", "#deleteModal");
                        del_but.setAttribute("data-id", el.id);
                        let deleteBtn = document.createElement("i");
                        deleteBtn.setAttribute(
                            "class",
                            "bi bi-trash3 open-delete"
                        );
                        deleteBtn.addEventListener("click", deleteFuncton);
                        del_but.appendChild(deleteBtn);
                        td.appendChild(del_but);
                        tr.appendChild(td);
                    }
                }
            }
        }

        table_tbody.appendChild(tr);
    });

    // ================= dinamic Table js function ==================== //

    const allTr = document.querySelectorAll(".table tr");
    allTr.forEach((el) => {
        el.addEventListener("click", (e) => {
            allTr.forEach((el) => {
                el.classList.remove("backgroundClass");
            });
            dinamicTableFunction(e, el);
        });
    });

    // ================= dinamic Table  js function end =============== //
}


//-------------------------------- fetch Post ---------------------------- //

let last_page = 1;
let current_page = 0;

async function postData(propsData, method, url, parent) {
    const postUrl = url;
    try {
        const response = await fetch(postUrl, {
            method: method,
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(propsData),
        });
        if (!response.ok) {
            throw new Error("Network response was not ok");
        } else {
            if (method === "POST") {
                const responseData = await response.json();
                current_page = responseData.current_page;
                last_page = responseData.last_page;
                const data = responseData.data;

                if (parent) {
                    parent.closest(".searchBlock").style.display = "none";
                }
                sc_name === "dictionary"
                    ? printResponsDictionary(data)
                    : sc_name === "open"
                    ? printResponsData(responseData)
                    : "";

                if (sc_name == "dictionary") {
                    const editBtn = document.querySelectorAll(".my-edit");
                    const closeBtns = document.querySelectorAll(".my-close");
                    const subBtns = document.querySelectorAll(".my-sub");
                    const basketIcons = document.querySelectorAll(".bi-trash3");

                    for (let i = 0; i < editBtn.length; i++) {
                        editBtn[i].addEventListener("click", editFunction);
                        closeBtns[i].addEventListener("click", closeFunction);
                        subBtns[i].addEventListener("click", saveFunction);
                        basketIcons[i].addEventListener("click", deleteFuncton);
                    }
                }
            } else {
                parent.remove();
            }
        }
    } catch (error) {
        console.error("Error:", error);
    }
}
// -------------------------------- fetch post end ---------------------------- //

// ------------------------ scroll fetch ------------------------------------------ //

const table_div = document.querySelector(".table_div");
table_div?.addEventListener("scroll", () => {
    const scrollPosition = table_div.scrollTop;
    if (scrollPosition > lastScrollPosition) {
        const totalHeight = table_div.scrollHeight;
        const visibleHeight = table_div.clientHeight;
        if (totalHeight - (scrollPosition + visibleHeight) <= 1) {
            page++;
            if (last_page > current_page) {
                searchFetch();
            }
        }
    }
    lastScrollPosition = scrollPosition;
});

// -------------------------------- fetch scroll end ----------------------------- //

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
// if (sc_name && sc_name !== "open") {
th.forEach((el) => {
    el.addEventListener("click", () => sort(el));
});
// }

function searchFetch(parent, inputValue, obj) {
    let data = [];
    let parentObj = {};
    let actions = [];
    let search_result;
    if (tb_name === "man") {
        if (obj) {
            search_result = obj;
        } else {
            search_result = {
                id: id_filter_input.value,
                bibliography_id: bibliography_id,
                first_name: man_search_inputs[0].value,
                last_name: man_search_inputs[1].value,
                middle_name: man_search_inputs[2].value,
                full_name: full_name_input.value,
            };
        }
    }

    allI.forEach((el, idx) => {
        let field_name = el.getAttribute("data-field-name");
        let searchBlockItem = el.parentElement.querySelector(".searchBlock");
        let selectblockChildren = searchBlockItem.children;

        if (inputValue) {
            el.getAttribute("data-field-name") === "name"
                ? (el
                      .closest("th")
                      .querySelector(".searchBlock").children[1].value = "%-%")
                : "";
            el.getAttribute("data-field-name") === "name"
                ? (el
                      .closest("th")
                      .querySelector(".searchBlock").children[2].value =
                      inputValue)
                : "";
        } else if (inputValue == "") {
            el.getAttribute("data-field-name") === "name"
                ? (el
                      .closest("th")
                      .querySelector(".searchBlock").children[2].value = "")
                : "";
        }

        if (
            el.hasAttribute("aria-complex") &&
            selectblockChildren[2].value !== "" &&
            selectblockChildren[5].value !== ""
        ) {
            parentObj = {
                name: field_name,
                sort: el.parentElement.getAttribute("data-sort"),
                bibliography_id: bibliography_id,
                actions: [
                    {
                        action: selectblockChildren[1].value,
                        value: selectblockChildren[2].value,
                    },
                    {
                        action: selectblockChildren[4].value,
                        value: selectblockChildren[5].value,
                    },
                ],
                query: selectblockChildren[3].childNodes[0].value,
                table_name: tb_name,
                section_name: sc_name,
            };

            data.push(parentObj);
            parentObj = {};
            actions = [];
        } else {
            if (searchBlockItem && selectblockChildren[2].value !== "") {
                parentObj = {
                    name: field_name,
                    sort: el.parentElement.getAttribute("data-sort"),
                    bibliography_id: bibliography_id,
                    actions: [
                        {
                            action: selectblockChildren[1].value,
                            value: selectblockChildren[2].value,
                        },
                    ],
                    table_name: tb_name,
                    section_name: sc_name,
                };
                data.push(parentObj);
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
                bibliography_id: bibliography_id,
                name: field_name,
                sort: el.parentElement.getAttribute("data-sort"),
                table_name: tb_name,
                section_name: sc_name,
            };
            data.push(parentObj);
            parentObj = {};
        }
    });
    console.log(data);
    let ressult = {
        filter: data,
        search: search_result,
    };
    // fetch post Function //

    if (tb_name == "man") {
        postData(ressult, "POST", `/filter/man/man/${page}`, parent);
    } else {
        postData(ressult, "POST", `/filter/${page}`, parent);
    }
}

// =========================================================
//                search inputs js
// =========================================================

function changeInputFunc() {
    if (
        man_search_inputs[0].value !== "" ||
        man_search_inputs[1].value !== "" ||
        man_search_inputs[2].value !== ""
    ) {
        full_name_input.setAttribute("disabled", "disabled");
        id_filter_input.setAttribute("disabled", "disabled");
    } else if (
        man_search_inputs[0].value === "" &&
        man_search_inputs[1].value === "" &&
        man_search_inputs[2].value === ""
    ) {
        full_name_input.removeAttribute("disabled");
        id_filter_input.removeAttribute("disabled");
    }
}
man_search_inputs?.forEach((el) =>
    el.addEventListener("input", () => changeInputFunc())
);
full_name_input?.addEventListener("input", () => {
    if (full_name_input.value !== "") {
        man_search_inputs.forEach((el) => {
            el.setAttribute("disabled", "disabled");
        });
        id_filter_input.setAttribute("disabled", "disabled");
    } else {
        man_search_inputs.forEach((el) => el.removeAttribute("disabled"));
        id_filter_input.removeAttribute("disabled");
    }
});
id_filter_input?.addEventListener("input", (e) => {
    if (isNaN(+e.target.value) || e.target.value === "") {
        e.target.value = "";
        man_search_inputs.forEach((el) => el.removeAttribute("disabled"));
        full_name_input.removeAttribute("disabled");
    } else if (e.target.value !== "") {
        man_search_inputs.forEach((el) => {
            el.setAttribute("disabled", "disabled");
        });
        full_name_input.setAttribute("disabled", "disabled");
    }
});
function searchInputsFunc() {
    page = 1;
    let obj = {
        id: id_filter_input.value,
        bibliography_id: bibliography_id,
        first_name: man_search_inputs[0].value,
        last_name: man_search_inputs[1].value,
        middle_name: man_search_inputs[2].value,
        full_name: full_name_input.value,
    };
    searchFetch(null, null, obj);
}
search_input_btn?.addEventListener("click", searchInputsFunc);
// =========================================================
//                 search inputs js end
// =========================================================
window.onload = () => {
    searchFetch();
};