const filterBlock = document.querySelectorAll(".table tr th i");
const block = document.getElementById("searchBlock");
const blockId = document.querySelector(".search_id_block");
let left = null;
let test = null;
let open = false;

filterBlock.forEach((el) => {
    el.addEventListener("click", (e) => {
        el.setAttribute("data", "filter");
        open = !open;
        if (open) {
            createDivSearch(e);
        } else {
            searchBlogNone(e);
        }
    });
});

function searchBlogNone() {
    block.style = `
       transform: rotateX(90deg);
       top: 210px;
       left:${left}px;
     `;
}

function createDivSearch(e) {
    const filterBlock = e.target;
    const rect = filterBlock.getBoundingClientRect();
    const th = document.querySelector(".table th");
    let t = th.getBoundingClientRect();
    const scrollLeft =
        window.pageXOffset || document.documentElement.scrollLeft;
    left = rect.left + scrollLeft;
    let card = document.querySelector(".card-body");
    console.log(e.target.parentElement.innerText);
    if (e.target.parentElement.innerText !== "Id") {
        if (
            card.offsetWidth < left ||
            card.offsetWidth - left < block.offsetWidth
        ) {
            console.log(card.offsetWidth - left, "b", block.offsetWidth);
            left = card.offsetWidth + block.offsetWidth;
            console.log(card.offsetWidth + block.offsetWidth);
            block.style = `
      top:${t.top + 40}px;
      right: 40px;
      transform: rotateX(0deg);
    `;
        } else if (card.offsetWidth > left) {
            block.style = `
      top:${t.top + 40}px;
      left:${left}px;
      transform: rotateX(0deg);
      `;
        }
    } else {
        if (
            card.offsetWidth < left ||
            card.offsetWidth - left < block.offsetWidth
        ) {
            console.log(card.offsetWidth - left, "b", block.offsetWidth);
            left = card.offsetWidth + block.offsetWidth;
            console.log(card.offsetWidth + block.offsetWidth);
            blockId.style = `
      top:${t.top + 40}px;
      right: 40px;
      transform: rotateX(0deg);
    `;
        } else if (card.offsetWidth > left) {
            blockId.style = `
      top:${t.top + 40}px;
      left:${left}px;
      transform: rotateX(0deg);
      `;
        }
    }
}

// document.body.addEventListener('click',(e) => {
//   console.dir(e.target.innerText);
//     if(e.target.data !=='filter'){
//       searchBlogNone()
//       open = !open
//     }

// })

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
