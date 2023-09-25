//  add search Blog functon //
const block = document.getElementById("searchBlock");
let left = null;
let test = null;
let right = null;
const allI = document.querySelectorAll(".filter-th i");

allI.forEach((el, idx) => {
    const blockDiv = document.createElement("div");
    if (el.parentElement.innerText === "Id") {
        el.setAttribute("data", "filter");
        blockDiv.id = "searchBlock";

        const p = document.createElement("p");
        p.textContent = "Փնտրել նաև";
        blockDiv.appendChild(p);

        const select = document.createElement("select");
        select.id = "searchBlock_section";

        const options = [
            "Հավասար է",
            "Հավասար չէ",
            "Մեծ է",
            "Մեծ է կամ հավասար",
            "Փոքր է",
            "Փոքր է կամ հավասար",
        ];

        options.forEach((optionText) => {
            const option = document.createElement("option");
            option.textContent = optionText;
            select.appendChild(option);
        });

        blockDiv.appendChild(select);

        const input = document.createElement("input");
        input.type = "number";
        input.min = "0";
        input.placeholder = "search";
        input.id = "searchBlock_input";
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
    } else {
        el.setAttribute("data", "filter");
        blockDiv.id = "searchBlock";

        const p = document.createElement("p");
        p.textContent = "Փնտրել նաև";
        blockDiv.appendChild(p);

        const select = document.createElement("select");
        select.id = "searchBlock_section";

        const options = ["Պարունակում է", "Սկսվում է"];

        options.forEach((optionText) => {
            const option = document.createElement("option");
            option.textContent = optionText;
            select.appendChild(option);
        });

        blockDiv.appendChild(select);

        const input = document.createElement("input");
        input.type = "text";
        input.placeholder = "search";
        input.id = "searchBlock_input";
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

    let searchBlocks = document.querySelectorAll("#searchBlock");
    el.addEventListener("click", (e) => {
        const filterBlock = e.target;
        const rect = filterBlock.getBoundingClientRect();
        right = rect.right;
        let th = el.parentElement.getBoundingClientRect();
        let top = th.top + th.height;
        let card = document.querySelector(".card-body");
        let cardWidth = card.getBoundingClientRect();

        console.log(right + 200, cardWidth.width);
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
            console.log(
                blockDiv.style.display,
                "e",
                e.target.getAttribute("data"),
                e.target.getAttribute("id")
            );
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

// resiz Function //

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

// searchBlock js //

let clearBtn = document.querySelector("#clear_btn");
// clearBtn.onclick = () => {
//   let searchInp = document.querySelector('.searchBlock_input')
//   searchInp.value = ''
// }

// isActive notActive js //

const allRangeInp = document.querySelectorAll(".rangeInput");
allRangeInp.forEach((el) => {
    el.addEventListener("change", (e) => {
        let cancel = document.querySelector("#cancel_btn");
        let confirm = document.querySelector("#isActive_button");
        cancel.onclick = () => {
            if (e.target.value === "1") {
                e.target.value = 0;
            } else if (e.target.value === "0") {
                e.target.value = 1;
            }
        };

        confirm.onclick = () => {
            let statusForm = document.querySelector("#status_form");
            let newInp = document.createElement("input");
            newInp.taype = "range";
            newInp.min = "0";
            newInp.max = "1";
            newInp.setAttribute("value", e.target.value);
            newInp.style.display = "none";
            let dataId = e.target.getAttribute("data-id");
            newInp.setAttribute("data-id", dataId);
            statusForm.appendChild(newInp);
            statusForm.action = `aaa/url/${dataId}`;
            console.log(statusForm);
        };
    });
});
