//  add search Blog functon //
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
    table_tbody.innerHTML = "";
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
            <a class="my-edit" href="#"><i class="bi bi-pencil-square"></i></a>
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
                const data = responseData.data;
                if (parent) {
                    console.log(parent);
                    parent.closest(".searchBlock").style.display = "none";
                }
                printRespons(data);

                if (document.querySelectorAll(".my-edit")) {
                    const editBtn = document.querySelectorAll(".my-edit");
                    const saveBtn = document.querySelectorAll(".my-sub");
                    const closeBtn = document.querySelectorAll(".my-close");

                    for (let i = 0; i < editBtn.length; i++) {
                        editBtn[i].addEventListener("click", editFunction);
                        saveBtn[i].addEventListener("click", saveFunction);
                        closeBtn[i].addEventListener("click", closeFunction);
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

// -------------------------------- fetch get --------------------------------- //
let page = 1;
const perPage = 10;
let lastScrollPosition = 0;

function fetchData() {
    const url = `https://restcountries.com/v3.1/all?fields=name,population&page=${page}&per_page=${perPage}`;

    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            handleData(data);
            page++;
        })
        .catch((error) => {
            console.error("Ошибка при загрузке данных:", error);
        });
}

// ------------------------ print data function ------------------------------- //
function handleData(data) {
    // console.log(data);
}
// ------------------------ end print data function ------------------------------- //

const cardBody = document.querySelector(".card-body");

cardBody.addEventListener("scroll", () => {
    const scrollPosition = cardBody.scrollTop;

    if (scrollPosition > lastScrollPosition) {
        const totalHeight = cardBody.scrollHeight;
        const visibleHeight = cardBody.clientHeight;
        if (totalHeight - (scrollPosition + visibleHeight) === 0) {
            fetchData();
        }
    }

    lastScrollPosition = scrollPosition;
});

fetchData();

// -------------------------------- fetch get end ----------------------------- //

// -------------------------------- filter data post -------------------------- //

const searchBtn = document.querySelectorAll(".serch-button");

let th = document.querySelectorAll(".filter-th");
function sort(el) {
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
    postData(data, "POST", "/filter", parent);
    page = 1;
}
searchBtn.forEach((el) => {
    el.addEventListener("click", () => searchFetch(el));
});

// --------------------------- clsear buttons serchblock ---------------------------- //

const delButton = document.querySelectorAll(".delButton");

delButton.forEach((el) => {
    el.addEventListener("click", (e) => {
        const parent = el.closest(".searchBlock");
        const SearchBlockSelect = parent.querySelectorAll("select");
        const SearchBlockInput = parent.querySelectorAll("input");
        console.log(parent);

        console.log(SearchBlockSelect);

        SearchBlockSelect.forEach((element) => {
            element.selectedIndex = 0;
        });

        SearchBlockInput.forEach((element) => {
            element.value = "";
        });

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

basketIcons.forEach((el) => {
    el.addEventListener("click", () => {
        elId = el.parentElement.getAttribute("data-id");
        let table = el.closest(".table");
        dataDeleteUrl = table.getAttribute("data-delete-url");
        table_name = table.getAttribute("data-table-name");
        section_name = table.getAttribute("data-section-name");
    });
});
let formDelet = document.getElementById("delete_form");

function deleteUserFuncton() {
    formDelet.action = `${dataDeleteUrl}${elId}`;
    console.log(formDelet.action);
}

formDelet.addEventListener("submit", (e) => {
    e.preventDefault();
    let form = document.getElementById("delete_form");
    url = form.getAttribute("action");
    let parent_id = e.target.getAttribute("action").split("/")[3];
    let parent = null;
    console.log(e.target);
    parent = document.querySelector(`[data-id="${parent_id}"]`).closest("tr");
    console.log(
        document.querySelector(`[data-id="${parent_id}"]`).closest("tr")
    );
    postData(
        {
            section_name: section_name,
        },
        "DELETE",
        url,
        parent
    );
});

deleteBtn.addEventListener("click", deleteUserFuncton);
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
