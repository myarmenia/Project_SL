const editBtn = document.querySelectorAll(".my-edit");
const saveBtn = document.querySelectorAll(".my-sub");
const closeBtn = document.querySelectorAll(".my-close");
let started_value = "";
let table_parent = ''
let tr_parent = "";
let td_parent = "";
let input = "";
let span = "";
let changes_permision = 1;

editBtn.forEach((el) => {
    el.addEventListener("click", editFunction);
});

saveBtn.forEach((el) => {
    el.addEventListener("click", saveFunction);
});

closeBtn.forEach((el) => {
    el.addEventListener("click", closeFunction);
});

// ====================================================================================

// Edit function

// ====================================================================================

function editFunction() {
    if (changes_permision) {
        tr_parent = this.closest("tr");
        td_parent = this.closest("td");
        input = tr_parent.querySelector(".edit_input");
        span = tr_parent.querySelector(".started_value");
        started_value = span.innerText;

        // remove icons
        this.classList.add("btns-none");
        td_parent.querySelector(".my-delete-item").classList.add("btns-none");

        // show icons
        td_parent.querySelector(".my-sub").classList.add("active-btns");
        td_parent.querySelector(".my-close").classList.add("active-btns");

        // remove span and set input value starte value
        span.innerText = "";
        input.value = started_value;

        // show input

        input.classList.add("active-input");

        //edit change permision
        changes_permision = 0;
    }
}

// ====================================================================================

// close function

// ====================================================================================

function closeFunction() {
    // remove icons
    td_parent.querySelector(".my-sub").classList.remove("active-btns");
    td_parent.querySelector(".my-close").classList.remove("active-btns");

    // show icons
    td_parent.querySelector(".my-delete-item").classList.remove("btns-none");
    td_parent.querySelector(".my-edit").classList.remove("btns-none");

    // set span started value

    span.innerText = started_value;

    // remove input

    input.classList.remove("active-input");

    //edit change permision
    changes_permision = 1;
}

// ====================================================================================

// Save function

// ====================================================================================

function saveFunction() {
    // span.innerText = current_value;
    table_parent = tr_parent.closest("table");
    let request_value = "";

    // fetch

    if(input.value != '') {
        fetch_request();
    }else {
        alert('լրացնել դաշտը')
    }
}

function fetch_request() {
    const request_url =
        table_parent.getAttribute("data-edit-url") +
        tr_parent.querySelector(".trId").innerText;

    console.log(request_url);

    const request_data = {
        name: input.value,
    };

    const requestOption = {
        method: "PATCH",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(request_data),
    };

    fetch(request_url, requestOption).then(async (res) => {
        if (!res) {
            console.log("error");
        } else {
            const { data } = await res.json();

            // remove icons
            td_parent.querySelector(".my-sub").classList.remove("active-btns");
            td_parent
                .querySelector(".my-close")
                .classList.remove("active-btns");

            // show icons
            td_parent
                .querySelector(".my-delete-item")
                .classList.remove("btns-none");
            td_parent.querySelector(".my-edit").classList.remove("btns-none");

            // remove input
            input.classList.remove("active-input");

            //edit change permision
            changes_permision = 1;

            span.textContent = input.value;
        }
    });
}


const myFormAction = document.querySelector(".my-form-class");

const createUrl = document
    .getElementById("resizeMe")
    .getAttribute("data-create-url");

const myOpModal = document.querySelector(".my-opModal");

myOpModal.addEventListener("click", (e) => {
    myFormAction.action = createUrl;
});
