const editBtn = document.querySelectorAll(".my-edit");
const myinp = document.querySelectorAll("td input");

editBtn.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        btn.closest("tr").querySelector("input").classList.add("active-input");
        btn.parentElement.querySelectorAll(".my-btn-class").forEach((el) => {
            el.classList.add("active-btns");
        });
        btn.classList.add("btns-none");
        btn.closest("tr")
            .querySelectorAll(".btn_close_modal")
            .forEach((el) => {
                el.classList.add("btns-none");
            });
        btn.closest("tr").querySelector(".tdTxt input").value = btn
            .closest("tr")
            .querySelector(".tdTxt span")
            .textContent.trim();
        btn.closest("tr").querySelector(".tdTxt span").textContent = "";
    });
});

let changes_result = null;
const closeBtns = document.querySelectorAll(".my-close");

closeBtns.forEach((btn) => {
    let started_value = btn
        .closest("tr")
        .querySelector(".tdTxt span").textContent;

    btn.addEventListener("click", (e) => {
        btn.parentElement.querySelectorAll(".my-btn-class").forEach((el) => {
            el.classList.remove("active-btns");
        });
        btn.closest("tr")
            .querySelectorAll(".btn_close_modal")
            .forEach((el) => {
                el.classList.remove("btns-none");
            });
        editBtn.forEach((el) => {
            el.classList.remove("btns-none");
        });
        btn.closest("tr")
            .querySelector("input")
            .classList.remove("active-input");

        // if (changes_result === null) {
        //     btn.closest("tr").querySelector(".tdTxt span").textContent =
        //         started_value;
        // } else {
        //     btn.closest("tr").querySelector(".tdTxt span").textContent =
        //         changes_result;
        // }
        btn.closest("tr").querySelector(".tdTxt span").textContent =
            changes_result;
    });
});

const subBtns = document.querySelectorAll(".my-sub");

subBtns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        changes_result = btn.closest("tr").querySelector("input").value;

        btn.closest("tr")
            .querySelector("input")
            .classList.remove("active-input");

        editBtn.forEach((el) => {
            el.classList.remove("btns-none");
        });

        btn.closest("tr")
            .querySelectorAll(".btn_close_modal")
            .forEach((el) => {
                el.classList.remove("btns-none");
            });

        btn.parentElement.querySelectorAll(".my-btn-class").forEach((el) => {
            el.classList.remove("active-btns");
        });

        // ================================================
        // fetch
        // ================================================

        const tdEditUrl ='/'+
            document.getElementById("resizeMe").getAttribute("data-edit-url") +
            btn.closest("tr").querySelector(".trId").textContent;

        const newTitle = {
            name: btn.closest("tr").querySelector(".tdTxt input").value,
            // id:   btn.closest('tr').querySelector('.trId').textContent
        };

        console.log(newTitle);

        const requestOption = {
            method: "PATCH",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(newTitle),
        };

        fetch(tdEditUrl, requestOption).then(async (res) => {
            if (!res) {
                console.log("error");
            } else {
                const { data } = await res.json();
                
                btn.closest("tr").querySelector(".tdTxt span").textContent = btn
                    .closest("tr")
                    .querySelector(".tdTxt input").value;
            }
        });
    });
});

// =========================================================================

const myFormAction = document.querySelector(".my-form-class");

const createUrl = document
    .getElementById("resizeMe")
    .getAttribute("data-create-url");

console.log(createUrl);

const myOpModal = document.querySelector(".my-opModal");

myOpModal.addEventListener("click", (e) => {
    myFormAction.action = createUrl;
});
