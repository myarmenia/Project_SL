// let div = document.createElement('div');
// div.id = 'modal';
// div.style.display = "block";
//////////////////////////////////////////////////////////////////////////////////////////////////////
let div = document.getElementById("modal");
div.style.opacity = 1;
div.style.display = "none";
const a = document.getElementById("app");
// const paragraphP = document.querySelectorAll(".m-4")
document.addEventListener("mouseup", (e) => {
    const b = window.getSelection();
    div.style.display = "block";
    if (
        div.style.opacity === "1" &&
        e.target !== div &&
        e.target !== textTextarea &&
        e.target !== select_text &&
        e.target !== button_modal
    ) {
        // div.style.display = "none";

        div.style.opacity = 0;
    }
    // console.log("aaaaaa",e.target === a);// ------------
    // console.log(paragraphP.forEach(el =>{
    //     if (e.target === el && b.toString()) {
    //       console.log("e_target", e.target);
    //       console.log("trrrru");
    //     }
    // }));
    // if (e.target === a && b.toString()) { --araj senc er
    if (b.toString()) {
        // div.textContent = '';
        let modal_text = "";

        let oRange = b.getRangeAt(0); //get the text range
        console.log(oRange);
        let oRect = oRange.getBoundingClientRect();
        console.log(oRect);
        div.style.position = "absolute";
        div.style.left = `${e.clientX - 150}px`;
        // div.style.left = `${oRect.x + oRect.width}px`;
        modal_text = b.toString().trim();
        // div.textContent = b.toString().trim();
        // div.style.display = "block";
        console.log("Selected_text:", modal_text);
        div.style.opacity = 1;

        a.appendChild(div);
        const rc = div.getBoundingClientRect();
        // div.style.top = `${e.clientY - rc.height / 2 + oRect.height / 2}px`;
        // div.style.top = `${oRect.y - rc.height / 2 + oRect.height / 2 - 80}px`; araj es er
        div.style.top =
            window.innerHeight - e.clientY > 160
                ? `${e.pageY - 150}px`
                : `${e.pageY - 330}px`;
        console.log(e.pageY, "pageY");
        console.log(e.screenY, "screenY");
        console.log(e.clientY, "clientY");
        console.log(window.innerHeight - e.clientY);
        /////////

        const select_text = document.getElementById("select_text");
        select_text.textContent = modal_text;

        const button_modal = document.getElementById("button_modal");
        button_modal.addEventListener("click", (e) => {
            e.stopPropagation();
            const textTextarea = document.getElementById("text_modal");
            console.log("textTextarea", textTextarea.value);
            console.log("modal_text", modal_text);
            fetch(`content-tag-store`, {
                method: "PATCH",
                headers: {
                    "Content-Type": "application/json",
                    // 'X-CSRF-TOKEN':csrf
                },
                body: JSON.stringify({
                    content:modal_text,
                    tag:textTextarea.value
                }),
            })
                // .then((response) => response.json())
                .then((data) => {
                    console.log("data", data);
                })
                .catch((error) => {
                    console.log("Произошла ошибка", error);
                });
        });


    }
});
/////vor textarean chpagvi////////////////////
const textTextarea = document.getElementById("text_modal");
textTextarea.addEventListener("mousedown", (e) => {
    e.stopPropagation();
});
const select_text = document.getElementById("select_text");
select_text.addEventListener("mousedown", (e) => {
    e.stopPropagation();
});

// const button_modal = document.getElementById("button_modal");
// button_modal.addEventListener("click", (e) => {
//     e.stopPropagation();
// console.log(textTextarea.value, ".value");
//   fetch(``, {
//     method: "PATCH",
//     headers: {
//         "Content-Type": "application/json",
//         // 'X-CSRF-TOKEN':csrf
//     },
//     body: JSON.stringify({ }),
// })
//     // .then((response) => response.json())
//     .then((data) => {
//       console.log("data",data);
//     })
//     .catch((error) => {
//       console.log("Произошла ошибка", error);
//   });
// });

//////////////////////////////////////////////////////////////////////////////////////////////////////

// const modal_childs = modal_.
// modal_select.addEventListener('click', function () {
//   console.log('22225555');
// });

// const aa = document.getElementById('app');
// aa.addEventListener('click', function () {
//   const selectedText = window.getSelection().toString().trim();

//   if (selectedText) {
//     console.log('Selected_text: ' + selectedText);
//   }
// });

const modalClick = document.getElementById("modal_click");
const modalTop = document.getElementById("modalTop");

modalClick.addEventListener("click", function () {
    modalTop.style.display = "block";
    modalTop.style.opacity = "0.9";
    modalTop.style.visibility = "visible";
});

//modal close button
const closeButton = document.getElementById("close_button");
// const modalTop = document.getElementById("modalTop");

closeButton.addEventListener("click", function () {
    modalTop.style.display = "none";
    modalTop.style.opacity = "0";
    modalTop.style.visibility = "hidden";
});
///in modal button click

// const inmodal_button = document.getElementById("inmodal_button");

// inmodal_button.addEventListener("click", function () {
//     console.log("chiko");
// });

// function sendCompletedTAble() {
//     fetch(`/customAddFileData`, {
//         method: "POST",
//         headers: {
//             "Content-Type": "application/json",
//         },
//         body: JSON.stringify(),
//     })
//         .then((response) => response.json())
//         .then((data) => {
//             console.log("dataa", data);

//         })
//         .catch((error) => {
//             console.log("Произошла ошибка", error);
//         });
// }

const inmodal_button = document.getElementById("inmodal_button");

inmodal_button.addEventListener("click", function () {
    let customVal = document.querySelectorAll(".custom-add-name");
    let readyVal = {};
    customVal.forEach((val) => {
        // console.log(val.innerHTML.replace( /(<([^>]+)>)/ig, ''), "7777777")
        let attrName = val.getAttribute("name");
        // readyVal[attrName] = val.innerText;
        if (val.innerText !== originalValues[attrName]) {
            readyVal[attrName] = val.innerText;
        }
    });

    console.log(readyVal, "READYVAL");

    const fileName = document
        .getElementById("file-name")
        .getAttribute("file-name");
    fetch(`/customAddFileData/${fileName}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(readyVal),
    })
        .then((data) => {
            console.log(data);
            location.reload();
        })
        .catch((error) => {
            console.error("Ошибка:", error);
        });
});

// document.addEventListener('DOMContentLoaded', function() {
//   const tableRows = document.querySelectorAll('.tbody_elements_tr');
//   tableRows.forEach(function(row) {
//       const rowHeight = row.clientHeight;
//       if (rowHeight > 350) {
//           row.style.maxHeight = '350px';
//           row.style.overflowY = 'scroll';
//       }
//   });
// });

// document.addEventListener("DOMContentLoaded", function () {
//     const cells = document.querySelectorAll(".custom-add-name"); // Выбираем все ячейки с классом 'custom-add-name'

//     cells.forEach(function (cell) {
//         cell.style.maxHeight = "350px"; // Устанавливаем максимальную высоту для каждой ячейки
//         cell.style.overflowY = "auto"; // Добавляем вертикальный скролл, если содержимое превышает максимальную высоту
//     });
// });

// document.addEventListener('DOMContentLoaded', function() {
//   const cells = document.querySelectorAll('.custom-add-name');

//   cells.forEach(function(cell) {
//       cell.addEventListener('input', function() {
//           if (cell.scrollHeight > cell.clientHeight) {
//               cell.style.overflowY = 'scroll';
//           } else {
//               cell.style.overflowY = 'hidden';
//           }
//       });
//   });
// });

// const input = document.getElementById("input");
// const log = document.getElementById("log");

// // input.addEventListener("change", updateValue);

// // function updateValue(e) {
// //   log.textContent = e.target.value;
// // }

// function editText(e) {
//   log.innerHTML = e.value;
// }

////////////////////////////////////placeholder------------------------------------
let tdElement = document.querySelectorAll(".myTd");
let originalValues = {};

let obj = {
    name: "name",
    surname: "surname",
    patronymic: "patronymic",
    birthday: "22.07.1999",
    address: "address",
    findText: "findText",
    paragraph: "paragraph",
};

// tdElement.forEach((el) =>{
//   let attr = el.getAttribute("name");
//   let objAttr = obj[`${attr}`]
//   el.textContent = objAttr
// })
tdElement.forEach((el) => {
    let attr = el.getAttribute("name");
    let objAttr = obj[attr];
    el.textContent = objAttr;
    // Сохраните исходное значение в объект originalValues
    originalValues[attr] = objAttr;
});

// tdElement.forEach(el=>{
//   el.addEventListener("click", function () {
//     // if (el.textContent === el.getAttribute("name")) {
//         el.textContent = "";
//     // }
// });
// })
tdElement.forEach((el) => {
    el.addEventListener("click", function () {
        let attr = el.getAttribute("name");
        if (el.textContent === originalValues[attr]) {
            el.textContent = "";
        }
    });
});

// tdElement.forEach(el=>{
//   el.addEventListener("blur", function () {
//     let attr = el.getAttribute("name");
//     if (el.textContent.trim() === "") {
//         el.textContent =  obj[`${attr}`];
//     }
// });
// })
tdElement.forEach((el) => {
    el.addEventListener("blur", function () {
        let attr = el.getAttribute("name");
        if (el.textContent.trim() === "") {
            el.textContent = originalValues[attr];
        }
    });
});
