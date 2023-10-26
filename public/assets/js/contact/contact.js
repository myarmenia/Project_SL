// --------------------- contact js ---------------------- //

const openEye = document.querySelectorAll(".open-eye");

function showContactDiv() {
    // let testDiv = document.querySelector(".contact_block");
    // if (testDiv) {
    //     testDiv.remove();
    // }
    let buttonClassArr = [
        "bi bi-dash-lg",
        "bi bi-arrows-fullscreen",
        "bi bi-x-lg",
    ];
    let buttonIdArr = ["bi bi-dash-lg minimizeBtn", "bi bi-arrows-fullscreen maximizeBtn", "bi bi-x-lg closeBtn"];

    let contactBlock = document.createElement("div");
    contactBlock.className = "resizer_contact contact_block";

    let minMaxCloseBlockDiv = document.createElement("div");
    minMaxCloseBlockDiv.className = "minMaxClose-block";

    let buttonBlock = document.createElement("div");
    buttonBlock.className = "button-block";

    for (let i = 0; i < buttonClassArr.length; i++) {
        let icon = document.createElement("i");
        icon.className = buttonIdArr[i];
        buttonBlock.appendChild(icon);
    }
    buttonBlock.addEventListener('click',(e) => {
      e.preventDefault()
    })
    let contentDiv = document.createElement("div");
    contentDiv.className = "content";
    minMaxCloseBlockDiv.appendChild(buttonBlock);

    let ul = document.createElement("ul");
    for (let i = 0; i < 4; i++) {
        let li = document.createElement("li");
        li.innerText = "Lorem ipsum dolor sit amet.";
        let iconFill = document.createElement("i");
        iconFill.className = "bi bi-caret-down-fill";
        li.appendChild(iconFill);
        ul.appendChild(li);
    }
    contentDiv.appendChild(ul);
    contactBlock.append(minMaxCloseBlockDiv, contentDiv);

    document.body.appendChild(contactBlock);

    let div = document.querySelector(".contact_block");
    let content = document.querySelector(".content");
    let minimizeBtn = document.querySelectorAll(".minimizeBtn");
    let maximizeBtn = document.querySelectorAll(".maximizeBtn");
    let minMaxCloseBlock = document.querySelector(".minMaxClose-block");
    let closeBtn = document.querySelectorAll(".closeBtn");
    
    minimizeBtn.forEach(el => el.addEventListener("click", () => {
      let h3 = document.createElement("h3");
      el.closest('.contact_block').querySelector('.content').classList.add("minimized");
      el.closest('.contact_block').classList.remove("maximized");
      el.closest('.contact_block').classList.remove("resizer_contact");
      el.style.display = "none";
      el.closest('div').querySelector('.maximizeBtn').setAttribute('class',"bi bi-fullscreen maximizeBtn");
      el.closest('.contact_block').style.height = "50px";
      h3.innerText = "Lorem ipsum dolor sit amet.";
      h3.style.fontSize = "16px";
      h3.style.display = "flex";
      el.closest('.contact_block').querySelector('.minMaxClose-block').style.justifyContent = "space-between";
      el.closest('.contact_block').querySelector('.minMaxClose-block').insertAdjacentElement("afterbegin", h3);
  })
  )

    maximizeBtn.forEach(el => el.addEventListener("click", (e) => {
        if (e.target.className === "bi bi-arrows-fullscreen maximizeBtn") {
            el.closest('.contact_block').classList.add("maximized");
            el.closest('.contact_block').querySelector('.content').classList.remove("minimized");
            el.closest('div').querySelector('.minimizeBtn').style.display = "none";
            el.closest('.contact_block').classList.remove("resizer_contact");
            el.closest('div').querySelector('.maximizeBtn').setAttribute('class', "bi bi-fullscreen maximizeBtn");
            console.log('1');
        } else if (e.target.className === "bi bi-fullscreen maximizeBtn") {
          console.log('2');
            el.closest('.contact_block').style.height = "600px";
            el.closest('.contact_block').classList.remove("maximized");
            el.closest('.contact_block').classList.add("resizer_contact");
            el.closest('.contact_block').querySelector('.content').classList.remove("minimized");
            el.closest('div').querySelector('.minimizeBtn').style.display = "block";
            el.setAttribute('class',"bi bi-arrows-fullscreen maximizeBtn");
            el.closest('.contact_block').querySelector('.minMaxClose-block').querySelector("h3").remove();
            el.closest('.contact_block').querySelector('.minMaxClose-block').style.justifyContent = "end";
        }
    })
    )

    closeBtn.forEach(el => el.addEventListener("click", () => {
      el.closest('.contact_block').remove()
    })
    )

    let li = document.querySelectorAll(".content ul li");

    function showInfo(e) {
        let openCloseClass = e.target.children[0]?.className;
        let icon = e.target.querySelector("i");
        openCloseClass === "bi bi-caret-down-fill"
            ? icon.setAttribute("class", "bi bi-caret-up-fill ")
            : icon.setAttribute("class", "bi bi-caret-down-fill");
    }
    li.forEach((el) => el.addEventListener("click", (e) => showInfo(e)));

    let draggables = document.querySelectorAll(".minMaxClose-block");
    console.log(draggables);
    let elm = null
    let offsetX,
        offsetY,
        isDragging = false;

    draggables.forEach(el => el.addEventListener("mousedown", (e) => {
        isDragging = true;
        offsetX = e.clientX - el.getBoundingClientRect().left;
        offsetY = e.clientY - el.getBoundingClientRect().top;
      })
      )

    document.addEventListener("mousemove", (e) => {
        if (!isDragging) return;
        e.target.closest('.contact_block').style.left = e.clientX - offsetX + "px";
        e.target.closest('.contact_block').style.top = e.clientY - offsetY + "px";
    });

    document.addEventListener("mouseup", () => {
        isDragging = false;
    });

    document.addEventListener("mouseleave", () => {
        isDragging = false;
    });
}

openEye.forEach((el) => el.addEventListener("click", () => showContactDiv()));


// let li = document.querySelectorAll(".content ul li");
// console.log(li);

// function showInfo(e) {
//     let openCloseClass = e.target.children[0]?.className;
//     let icon = e.target.querySelector("i");
//     openCloseClass === "bi bi-caret-down-fill"
//         ? icon.setAttribute("class", "bi bi-caret-up-fill")
//         : icon.setAttribute("class", "bi bi-caret-down-fill");
// }

// li?.forEach((el) => el.addEventListener("click", (e) => showInfo(e)));

// ---------------------- contact js end ----------------------------------------- //