// ================================================
// fetch Relation
// ================================================
async function postRelationData(
    relation_data,
    method,
    url,
    parent,
    table_name,
    table_id
) {
    const postUrl = url;

    try {
        const response = await fetch(postUrl, {
            method: method,
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(relation_data),
        });
        if (!response.ok) {
            throw new Error("Network response was not ok");
        } else {
            let responce = await response.json();
            console.log(parent);
            parent.closest('.searchBlock').style.display = 'none'
            printTableRelationData(responce, table_name, table_id);
        }
    } catch (error) {
        console.error("Error:", error);
    }
}
// ================================================
// fetch Relation end
// ================================================

// ================================================
// filter data post
// ================================================
const allI = document.querySelectorAll(".filter-th i");
let tb_name;
let sc_name = document
    .querySelector(".table")
    ?.getAttribute("data-section-name");
let th = document.querySelectorAll(".filter-th");
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
const searchBtn = document.querySelectorAll(".serch-button");
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
function searchFetchBibliography(parent, filters_block) {
    let data = [];
    let parentObj = {};
    let actions = [];
    let table_id = null;
    if (parent.closest(".table_div").querySelector(".relation-table-id")) {
        table_id = parent
            .closest(".table_div")
            .querySelector(".relation-table-id")
            .getAttribute("data-table-id");
    }
    filters_block.forEach((el, idx) => {
        let field_name = el.closest('th').querySelector('i').getAttribute("data-field-name");
        let searchBlockItem = el.parentElement.querySelector(".searchBlock");
        let selectblockChildren = searchBlockItem.children;

        if (
            el.hasAttribute("aria-complex") &&
            selectblockChildren[2].value !== "" &&
            selectblockChildren[5].value !== ""
        ) {
            parentObj = {
                table_id: table_id,
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
                    table_id: table_id,
                    name: field_name,
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
                table_id: table_id,
                name: field_name,
                table_name: tb_name,
                section_name: sc_name,
            };
            data.push(parentObj);
            parentObj = {};
        }
    });
    // fetch post Function //
    console.log(data);
    postRelationData(
        data,
        "POST",
        `/filter-biblyography`,
        parent,
        tb_name,
        table_id
    );
}
searchBtn.forEach((el) => {
    el.addEventListener("click", (e) => {
        tb_name = el.closest(".table").getAttribute("data-filter-table-name");
        tb_name === null ? tb_name = 'man': ''
        let filters_block = el
            .closest(".table")
            ?.querySelectorAll(".filter-th .searchBlock");
        e.stopPropagation();
        el.closest("th").querySelector(".bi-funnel-fill").style.color =
            "#012970";
        searchFetchBibliography(el, filters_block);
    });
});

// ================================================
// filter data post end
// ================================================

// ================================================
// clear buttons serchblock
// ================================================

const delButton = document.querySelectorAll(".delButton");
delButton.forEach((el) => {
    el.addEventListener("click", (e) => {
        el.closest("th").querySelector(".bi-funnel-fill").style.color =
            "#b9b9b9";
            let filters_block = el
            .closest(".table")
            ?.querySelectorAll(".filter-th .searchBlock");
        const parent = el.closest(".searchBlock");
        const SearchBlockSelect = parent.querySelectorAll("select");
        const SearchBlockInput = parent.querySelectorAll("input");

        SearchBlockSelect.forEach((element) => {
            element.selectedIndex = 0;
        });

        SearchBlockInput.forEach((element) => {
            element.value = "";
        });
        searchFetchBibliography(parent,filters_block);
    });
});
// ================================================
// clear buttons serchblock end
// ================================================
// ================================================
// print table data
// ================================================
function printTableRelationData(data, table_name, table_id) {
    let tables = document.querySelectorAll(".table");
    let table;
    tables.forEach((el) => {
        if (
            el.getAttribute("data-table-id") === table_id &&
            el.getAttribute("data-filter-table-name") === table_name
        ) {
            table = el;
        }
    });
    // table.querySelector('body')
    table.querySelector("tbody").innerHTML = "";
    data.forEach((el) => {
        let birthday;
        el.birthday_str !== null ? birthday = el.birthday_str : birthday = ''
        let tr = document.createElement("tr");
        tr.innerHTML = `
        <td>${el.id}</td>
        <td>${el.first_name}</td>
        <td>${el.last_name}</td>
        <td>${el.middle_name}</td>
        <td>${birthday}</td>
        <td scope="row" class="td-icon text-center">
            <a href="/${lang}/man/${el.id}/edit"> <i class="bi bi-pen"></i></a>
        </td>
        <td scope="row" class="td-icon text-center">
            <i class="bi bi-folder2-open modalDoc" data-info="${el.id}"></i>
        </td>
        <td scope="row" class="td-icon text-center">
        <a target="blank">
            <i class="bi bi-eye open-eye"  data-id="${el.id}"></i>
        </a>
       </td>

        `;
        table.querySelector("tbody").appendChild(tr);

        let eyeIcon = table.querySelectorAll('.open-eye')
        eyeIcon.forEach(el => el.addEventListener('click',(e) => showCnntact(e)))

        let modalDoc = document.querySelectorAll(".modalDoc");
        modalDoc.forEach((el) =>  el.addEventListener("click", () =>  modalDocFunc(el)));
    });
}
// ================================================
// print table data end
// ================================================
