// let div = document.createElement('div');
// div.id = 'modal';
// div.style.display = "block";
//////////////////////////////////////////////////////////////////////////////////////////////////////
// let div = document.getElementById("modal");
// div.style.opacity = 1;
// div.style.display = "none";
// const a = document.getElementById("app");
// document.addEventListener("mouseup", (e) => {
//     const b = window.getSelection();
//     div.style.display = "block";
//     if (div.style.opacity === "1" && e.target !== div) {
//         // div.style.display = "none";

//         div.style.opacity = 0;
//     }
//     if (e.target === a && b.toString()) {
//         // div.textContent = '';
//         let modal_text = "";

//         let oRange = b.getRangeAt(0); //get the text range
//         let oRect = oRange.getBoundingClientRect();
//         console.log(oRect);
//         div.style.position = "absolute";
//         div.style.left = `${e.clientX - 150}px`;
//         // div.style.left = `${oRect.x + oRect.width}px`;
//         modal_text = b.toString().trim();
//         // div.textContent = b.toString().trim();
//         // div.style.display = "block";
//         console.log("Selected_text:", modal_text);
//         div.style.opacity = 1;

//         a.appendChild(div);
//         const rc = div.getBoundingClientRect();
//         // div.style.top = `${e.clientY - rc.height / 2 + oRect.height / 2}px`;
//         div.style.top = `${oRect.y - rc.height / 2 + oRect.height / 2 - 80}px`;
//     }
// });

// const modal_ = document.getElementById("modal");
// const child = document.querySelectorAll(".modal_select");

// child.forEach((el) => {
//     el.addEventListener("click", function () {
//         console.log(el.getAttribute("data-name"));
//     });
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
        readyVal[attrName] = val.innerText;
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
        .then((response) => response.json())
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
