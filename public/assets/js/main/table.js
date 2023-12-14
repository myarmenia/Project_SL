const block = document.getElementById("searchBlock");
let left = null;
let test = null;
let right = null;
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

allI.forEach((el, idx) => {
    const blockDiv = document.createElement("div");
    let data_type = el.parentElement.getAttribute("data-type");

    // filter-id and filter-complex and filter-complex-date options //
    const filterOptions = [
        {
            key: `${equal}`,
            value: "=",
        },
        {
            key: `${not_equal}`,
            value: "!=",
        },
        {
            key: `${more}`,
            value: ">",
        },
        {
            key: `${more_equal}`,
            value: ">=",
        },
        {
            key: `${less}`,
            value: "<",
        },
        {
            key: `${less_equal}`,
            value: "<=",
        },
    ];

    // standart-complex option //

    const standartComplexOption = [
        {
            key: `${contains}`,
            value: "%-%",
        },
        {
            key: `${start}`,
            value: "-%",
        },
        {
            key: `${equal}`,
            value: "=",
        },
        {
            key: `${not_equal}`,
            value: "!=",
        },
    ];

    // standart option //

    const standartOption = [
        {
            key: `${contains}`,
            value: "%-%",
        },
        {
            key: `${start}`,
            value: "-%",
        },
    ];

    // and or option //

    const queryOption = [
        {
            key: `${and_search}`,
            value: "and",
        },
        {
            key: `${or_search}`,
            value: "or",
        },
    ];

    if (data_type === "filter-id") {
        el.setAttribute("data", "filter");
        blockDiv.className = "searchBlock";

        const p = document.createElement("p");
        p.textContent = `${search_as}`;
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
        input.className = "searchBlock_input";
        blockDiv.appendChild(input);

        const buttonDiv = document.createElement("div");
        buttonDiv.className = "button_div";

        const searchButton = document.createElement("button");
        searchButton.className = "serch-button";
        searchButton.textContent = `${seek}`;
        buttonDiv.appendChild(searchButton);

        const delButton = document.createElement("button");
        delButton.className = "delButton";
        delButton.textContent = `${clean}`;
        buttonDiv.appendChild(delButton);

        blockDiv.appendChild(buttonDiv);

        el.parentElement.appendChild(blockDiv);
    } else if (data_type === "standart") {
        el.setAttribute("data", "filter");
        blockDiv.className = "searchBlock";

        const p = document.createElement("p");
        p.textContent = `${search_as}`;
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
        input.className = "searchBlock_input";
        blockDiv.appendChild(input);

        const buttonDiv = document.createElement("div");
        buttonDiv.className = "button_div";

        const searchButton = document.createElement("button");
        searchButton.className = "serch-button";
        searchButton.textContent = `${seek}`;
        buttonDiv.appendChild(searchButton);

        const delButton = document.createElement("button");
        delButton.className = "delButton";
        delButton.textContent = `${clean}`;
        buttonDiv.appendChild(delButton);

        blockDiv.appendChild(buttonDiv);

        el.parentElement.appendChild(blockDiv);
    } else if (data_type === "standart-complex") {
        el.setAttribute("data", "filter");
        blockDiv.className = "searchBlock";
        const p = document.createElement("p");
        p.textContent = `${search_as}`;
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
        input.className = "searchBlock_input";
        blockDiv.appendChild(input);

        const buttonDiv = document.createElement("div");
        buttonDiv.className = "button_div";

        const searchButton = document.createElement("button");
        searchButton.className = "serch-button";
        searchButton.textContent = `${seek}`;
        buttonDiv.appendChild(searchButton);

        const delButton = document.createElement("button");
        delButton.className = "delButton";
        delButton.textContent = `${clean}`;
        buttonDiv.appendChild(delButton);

        blockDiv.appendChild(buttonDiv);

        el.parentElement.appendChild(blockDiv);
    } else if (data_type === "filter-complex") {
        el.setAttribute("data", "filter");
        el.setAttribute("aria-complex", "true");
        blockDiv.className = "searchBlock";
        const p = document.createElement("p");
        p.textContent = `${search_as}`;
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
        searchButton.textContent = `${seek}`;
        buttonDiv.appendChild(searchButton);

        const delButton = document.createElement("button");
        delButton.className = "delButton";
        delButton.textContent = `${clean}`;
        buttonDiv.appendChild(delButton);

        blockDiv.appendChild(buttonDiv);

        el.parentElement.appendChild(blockDiv);
    } else if (data_type === "filter-complex-date") {
        el.setAttribute("data", "filter");
        el.setAttribute("aria-complex", "true");
        blockDiv.className = "searchBlock";
        const p = document.createElement("p");
        p.textContent = `${search_as}`;
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
        searchButton.textContent = `${seek}`;
        buttonDiv.appendChild(searchButton);

        const delButton = document.createElement("button");
        delButton.className = "delButton";
        delButton.textContent = `${clean}`;
        buttonDiv.appendChild(delButton);

        blockDiv.appendChild(buttonDiv);

        el.parentElement.appendChild(blockDiv);
    } else if (data_type === "standart-complex-number") {
        el.setAttribute("data", "filter");
        blockDiv.className = "searchBlock";
        const p = document.createElement("p");
        p.textContent = `${search_as}`;
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
        input.className = "searchBlock_input";
        blockDiv.appendChild(input);

        const buttonDiv = document.createElement("div");
        buttonDiv.className = "button_div";

        const searchButton = document.createElement("button");
        searchButton.className = "serch-button";
        searchButton.textContent = `${seek}`;
        buttonDiv.appendChild(searchButton);
        const delButton = document.createElement("button");
        delButton.className = "delButton";
        delButton.textContent = `${clean}`;
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
        // el.getAttribute('data-field-name') === 'name' ?  el.closest('th').querySelector('.searchBlock').children[2].value = '' : ''
        let inputSearch = document.querySelector(".search-dictionary");
        el.getAttribute("data-field-name") === "name" &&
        inputSearch.value !== ""
            ? (inputSearch.value = "")
            : "";
        e.stopPropagation();
    });
});

function printResponsDictionary(data) {
    let table_tbody = document.querySelector(".table_tbody");
    if (+page === 1) {
        table_tbody.innerHTML = "";
    }
    data.forEach((el) => {
        let obj_keys = Object.keys(el);

        let new_tr = document.createElement("tr");

        for (let i = 0; i < obj_keys.length + 1; i++) {
            let new_td = document.createElement("td");
            new_td.innerHTML = el[obj_keys[i]];
            if (i == 0) {
                new_td.setAttribute("class", "trId");
            }

            if (i == 1) {
                if (sc_name == "dictionary") {
                    new_td.innerHTML = "";
                    new_td.setAttribute("class", "tdTxt");
                    let span = document.createElement("span");
                    span.setAttribute("class", "started_value");
                    span.innerText = el[obj_keys[i]];
                    let input = document.createElement("input");
                    input.setAttribute("class", "form-control edit_input");

                    new_td.appendChild(span);
                    new_td.appendChild(input);
                }
            }

            if (i == obj_keys.length) {
                new_td.innerHTML = "";

                let new_a = document.createElement("a");
                new_a.setAttribute("class", "my-edit");
                new_a.setAttribute("style", "cursor: pointer");

                let new_i = document.createElement("i");
                new_i.setAttribute("class", "bi bi-pencil-square");

                new_a.appendChild(new_i);
                new_td.appendChild(new_a);

                let new_delete_btn = document.createElement("button");

                new_delete_btn.setAttribute(
                    "class",
                    "btn_close_modal my-delete-item"
                );
                new_delete_btn.setAttribute("data-bs-toggle", "modal");
                new_delete_btn.setAttribute("data-bs-target", "#deleteModal");
                new_delete_btn.setAttribute("data-id", el[obj_keys["id"]]);

                let new_d_i = document.createElement("i");

                new_d_i.setAttribute("class", "bi bi-trash3");

                new_delete_btn.appendChild(new_d_i);
                new_td.appendChild(new_delete_btn);

                if ((sc_name = "dictionary")) {
                    let sub_btn = document.createElement("button");
                    sub_btn.setAttribute(
                        "class",
                        "btn btn-primary my-btn-class my-sub"
                    );
                    sub_btn.innerText = "Թարմացնել";

                    sub_btn.setAttribute("style", "margin-right: 5px");

                    new_td.appendChild(sub_btn);

                    let close_btn = document.createElement("button");

                    close_btn.setAttribute(
                        "class",
                        "btn btn-secondary my-btn-class my-close"
                    );
                    close_btn.innerText = "Չեղարկել";

                    new_td.appendChild(close_btn);
                }
            }

            new_tr.appendChild(new_td);
        }

        table_tbody.appendChild(new_tr);
    });
}

function printResponsData(responseData) {
    let data = responseData.data;
    let count = document.querySelector(".count_block b");
    count.innerText = responseData.result_count;

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
        if(tb_name === 'man'){
            for (let i = -2; i <= 32 ; i++) {
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
                    if (i < 31) {
                        if (
                            obj_keys[i] !== "signal_has_man" &&
                            obj_keys[i] !== "man_passed_by_signal"
                        ) {
                            let td = document.createElement("td");
                           
                                if(i === 18 && tb_name === 'man'){
                                    let div = document.createElement('div')
                                    div.style = `
                                    white-space: initial;
                                    `
                                    td.style = `
                                    display: block;overflow-x: hidden; overflow-y: auto; height:70px; padding:10px
                                    `
                                    obj_values[i] === "null"
                                    ? (div.innerText = "")
                                    : (div.innerText = obj_values[i]);
                                    td.appendChild(div)
                                    tr.appendChild(td);
                                }else{
                                    obj_values[i] === "null"
                                    ? (td.innerText = "")
                                    : (td.innerText = obj_values[i]);
                                    tr.appendChild(td);
                                }
                        }
                    } else if (i === 31 && main_route) {
                        let td = document.createElement("td");
                        td.innerHTML = `
                                <a href='/${lang}/add-relation?main_route=${main_route}&model_id=${model_id}&relation=${relation}&fieldName=${fieldName}&id=${obj_values[0]}'>
                                    <i class="bi bi-plus-square open-add" title="Ավելացնել"></i> </a> `;
                        td.style = `
                        text-align:center;
                        `;
                        tr.appendChild(td);
                    } else if (i === 32 && allow_delete === true) {
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
                        deleteBtn.setAttribute("class", "bi bi-trash3 open-delete");
                        deleteBtn.addEventListener("click", deleteFuncton);
                        del_but.appendChild(deleteBtn);
                        td.appendChild(del_but);
                        tr.appendChild(td);
                    }
                }
            }

        }else{
            for (let i = -2; i <= obj_keys.length +1 ; i++) {
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
                    } else if (i === obj_keys.length + 1 && allow_delete === true) {
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
                        deleteBtn.setAttribute("class", "bi bi-trash3 open-delete");
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
            dinamicTableFunction(e, el)
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

// -------------------------------- fetch get end ----------------------------- //

// -------------------------------- filter data post -------------------------- //

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
if (sc_name && sc_name !== "open" ) {
    th.forEach((el) => {
        el.addEventListener("click", () => sort(el));
    });
}

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
                id:id_filter_input.value,
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
                name: field_name,
                sort: el.parentElement.getAttribute("data-sort"),
                table_name: tb_name,
                section_name: sc_name,
            };
            data.push(parentObj);
            parentObj = {};
        }
    });
    let ressult = {
        filter: data,
        search: search_result,
    };
    // fetch post Function //
    postData(ressult, "POST", `/filter/${page}`, parent);
}
searchBtn.forEach((el) => {
    el.addEventListener("click", () => {
        el.closest("th").querySelector(".bi-funnel-fill").style.color = "#012970";
        page = 1;
        searchFetch(el);
    });
});

// --------------------------- clear buttons serchblock ---------------------------- //

const delButton = document.querySelectorAll(".delButton");

delButton.forEach((el) => {
    el.addEventListener("click", (e) => {
        el.closest("th").querySelector(".bi-funnel-fill").style.color = "#b9b9b9";
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

// ----------------------------- global delete function --------------------------- //

let url = null;
let elId = null;
let dataDeleteUrl = null;
let table_name = null;
let section_name = null;

const deleteBtn = document.querySelector("#delete_button");
const basketIcons = document.querySelectorAll(".bi-trash3");

let formDelet = document.getElementById("delete_form");

basketIcons.forEach((el) => {
    el.addEventListener("click", deleteFuncton);
});

let remove_element = "";

function deleteFuncton() {
    elId = this.parentElement.getAttribute("data-id");
    let table = this.closest(".table");
    dataDeleteUrl = table.getAttribute("data-delete-url");
    table_name = table.getAttribute("data-table-name");
    section_name = table.getAttribute("data-section-name");
    formDelet.action = `${dataDeleteUrl}${elId}`;

    remove_element = this.closest("tr");
}

if (formDelet) {
    formDelet.addEventListener("submit", (e) => {
        e.preventDefault();
        let form = document.getElementById("delete_form");
        url = form.getAttribute("action");

        parent = remove_element;

        postData(
            {
                section_name: section_name,
            },
            "DELETE",
            url,
            parent
        );
    });
}

// -------------------------- resiz Function -------------------------------------- //

document.addEventListener("DOMContentLoaded", (e) => {
    onMauseScrolTh();
});

function onMauseScrolTh(e) {
    const createResizableTable = function (table) {
        if (table) {
            const cols = table.querySelectorAll("th");
            [].forEach.call(cols, function (col) {
                const resizer = document.createElement("div");
                resizer.classList.add("resizer");
                resizer.style.height = table.offsetHeight + "px";
                col.appendChild(resizer);
                createResizableColumn(col, resizer);
            });
        }
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

    createResizableTable(document.getElementById("resizeMe"));
}

// -------------------------- end resiz Function  --------------------------------------

// ----------------------------- radzdel atkrit ------------------------------------

// ----------------------------- clear all filters function ------------------------

let clearBtn = document.querySelector("#clear_button");

clearBtn?.addEventListener("click", () => {
    if (tb_name === "man") {
        man_search_inputs.forEach((el) => {
            el.value = "";
            if (el.getAttribute("disabled")) {
                el.removeAttribute("disabled");
            }
        });
        full_name_input.value = "";
        if (full_name_input.getAttribute("disabled")) {
            full_name_input.removeAttribute("disabled");
        }
    }
    let filterIcon = document.querySelectorAll(".bi-funnel-fill");
    filterIcon.forEach((el) => (el.style.color = "#b9b9b9"));
    const searchBlockSelect = document.querySelectorAll("select");
    const searchBlockInput = document.querySelectorAll("input");
    searchBlockSelect.forEach((el) => {
        el.selectedIndex = 0;
    });
    searchBlockInput.forEach((el) => {
        el.value = "";
    });
    searchFetch();
});

// =========================================================
//                 optimization js
// =========================================================

// let button_table = document.querySelectorAll('.button-table')
// button_table?.forEach(el => {
//     el.addEventListener('click', () => {
//         button_table.forEach(el => {
//             if(el.className !== 'button-table btn btn-light'){
//                 el.classList.remove('btn-primary')
//                 el.classList.add('btn-light')
//             }
//         })
//         el.classList.remove('btn-light')
//         el.classList.add('btn-primary')
//     } )
// })

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
id_filter_input?.addEventListener('input',(e) => {
    if(isNaN(+e.target.value) || e.target.value === ''){
        e.target.value = ''
        man_search_inputs.forEach((el) => el.removeAttribute("disabled"));
        full_name_input.removeAttribute("disabled");
    }else if(e.target.value !== ''){
        man_search_inputs.forEach((el) => {
            el.setAttribute("disabled", "disabled");
        });
        full_name_input.setAttribute("disabled", "disabled");
    }
})
function searchInputsFunc(){
    page = 1
    let obj = {
        id: id_filter_input.value,
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
