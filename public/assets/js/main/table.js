//  add search Blog functon //
const block = document.getElementById("searchBlock");
let left = null;
let test = null;
let right = null;
const allI = document.querySelectorAll(".filter-th i");
let page = 1;
const perPage = 10;
let lastScrollPosition = 0;

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
    }

    const searchBlocks = document.querySelectorAll(".searchBlock");
    el.addEventListener("click", (e) => {
        searchBlocks.forEach((element) => {
            element.style.display = "none";
        });

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

allI.forEach((el) => {
    el.addEventListener("click", (e) => {
        e.stopPropagation();
    });
});

function printRespons(data) {
    let table_tbody = document.querySelector(".table_tbody");
    if (page == 1) {
        table_tbody.innerHTML = "";
    }
    data.forEach((el) => {
        table_tbody.innerHTML += `
        <tr>
        <td class="trId">${el.id}</td>
        <td class="tdTxt">
            <span class='started_value'>${el.name}</span>
            <input type="text" class="form-control edit_input" required placeholder="" />
            <div class="error-text">

            </div>
        </td>
        <td>
            <a class="my-edit" style='cursor: pointer'><i class="bi bi-pencil-square"></i></a>
            <button class="btn_close_modal my-delete-item" data-bs-toggle="modal"
                data-bs-target="#deleteModal" data-id="${el.id}"><i
                    class="bi bi-trash3"></i>
            </button>
            <button class="btn btn-primary my-btn-class my-sub">Թարմացնել</button>
            <button class="btn btn-secondary my-btn-class my-close">Չեղարկել</button>
        </td>
    </tr>
        `;
    });
}

//-------------------------------- fetch Post ---------------------------- //

let last_page = 1
let current_page = 0

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
                console.log(responseData);
                current_page = responseData.current_page
                last_page = responseData.last_page
                const data = responseData.data;
                if (parent) {
                    parent.closest(".searchBlock").style.display = "none";
                }
                if(data.length > 0){
                    printRespons(data);
                }
                const editBtn = document.querySelectorAll(".my-edit");
                const closeBtns = document.querySelectorAll(".my-close");
                const subBtns = document.querySelectorAll(".my-sub");
                const basketIcons = document.querySelectorAll(".bi-trash3");

                // editBtn.forEach((btn) => {
                //     btn.addEventListener("click", editRow);
                // });

                for (let i = 0; i < editBtn.length; i++) {
                    editBtn[i].addEventListener("click", editFunction);
                    closeBtns[i].addEventListener("click", closeFunction);
                    subBtns[i].addEventListener("click", saveFunction);
                    basketIcons[i].addEventListener("click", deleteFuncton);
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

// -------------------------------- fetch get --------------------------------- //

// function fetchData() {
//     const url = `https://restcountries.com/v3.1/all?fields=name,population&page=${page}&per_page=${perPage}`;

//     fetch(url)
//         .then((response) => response.json())
//         .then((data) => {
//             handleData(data);
//             page++;
//         })
//         .catch((error) => {
//             console.error("Ошибка при загрузке данных:", error);
//         });
// }

// ------------------------ print data function ------------------------------- //
// function handleData(data) {
//     console.log(data);
// }
// ------------------------ end print data function ------------------------------- //

// ------------------------ scroll fetch ------------------------------------------ //

const table_div = document.querySelector(".table_div");
console.log(table_div);
table_div.addEventListener("scroll", () => {
    const scrollPosition = table_div.scrollTop;
    if (scrollPosition > lastScrollPosition) {
        const totalHeight = table_div.scrollHeight;
        const visibleHeight = table_div.clientHeight;
        if (totalHeight - (scrollPosition + visibleHeight) < 1) {
            page++;
            if(last_page > current_page){

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

th.forEach((el) => {
    el.addEventListener("click", () => sort(el));
});

function searchFetch(parent) {
    let data = [];
    let parentObj = {};
    let actions = [];
    allI.forEach((el, idx) => {
        let field_name = el.getAttribute("data-field-name");
        let searchBlockItem = el.parentElement.querySelector(".searchBlock");
        let selectblockChildren = searchBlockItem.children;
        let tb_name = el.closest(".table").getAttribute("data-table-name");
        let sc_name = el.closest(".table").getAttribute("data-section-name");
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
    // fetch post Function //
    postData(data, "POST", `/filter/${page}`, parent);
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

formDelet.addEventListener("submit", (e) => {
    e.preventDefault();
    let form = document.getElementById("delete_form");
    url = form.getAttribute("action");
    console.log(url);
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

// deleteBtn.addEventListener("click", deleteUserFuncton);
// ----------------------------- clear all filters function ------------------------ //

// const clearBtn = document.querySelector("#clear_button");

// clearBtn.onclick = () => {
//   const searchBlockSelect = document.querySelectorAll("select");
//   const searchBlockInput = document.querySelectorAll("input");
//   searchBlockSelect.forEach((el) => {
//     el.selectedIndex = 0;
//   });
//   searchBlockInput.forEach((el) => {
//     el.value = "";
//   });
//   searchFetch();
// };

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

    createResizableTable(document.getElementById("resizeMe"));
}

// -------------------------- end resiz Function  -------------------------------------- //
