// let div = document.createElement('div');
// div.id = 'modal';
// div.style.display = "block";
let div = document.getElementById("modal");
div.style.opacity = 1;
div.style.display = "none";
const a = document.getElementById("app");
document.addEventListener("mouseup", (e) => {
    const b = window.getSelection();
    div.style.display = "block";
    if (div.style.opacity === "1" && e.target !== div) {
        // div.style.display = "none";

        div.style.opacity = 0;
    }
    if (e.target === a && b.toString()) {
        // div.textContent = '';
        let modal_text = "";

        let oRange = b.getRangeAt(0); //get the text range
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
        div.style.top = `${oRect.y - rc.height / 2 + oRect.height / 2 - 80}px`;
    }
});

const modal_ = document.getElementById("modal");
const child = document.querySelectorAll(".modal_select");

child.forEach((el) => {
    el.addEventListener("click", function () {
        console.log(el.getAttribute("data-name"));
    });
});

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
const aaa = document.getElementById("aaa");

modalClick.addEventListener("click", function () {
    modalTop.style.display = "block";
    modalTop.style.opacity = "1";
    modalTop.style.visibility = "visible";

    aaa.style.display = "block";
    aaa.style.opacity = "1";
    aaa.style.visibility = "visible";
});

