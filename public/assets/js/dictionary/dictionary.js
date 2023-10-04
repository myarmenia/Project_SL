const editBtn = document.querySelectorAll(".my-edit");
const myinp = document.querySelectorAll("td input");
const closeBtns = document.querySelectorAll(".my-close");
const subBtns = document.querySelectorAll(".my-sub");

editBtn.forEach((btn) => {
    btn.addEventListener("click", editRow);
});

closeBtns.forEach((btn) => {
    btn.addEventListener("click", closeBtn);
});

let started_value = null

function editRow(){
    started_value = this.closest("tr").querySelector(".tdTxt span").textContent;

    this.closest("tr").querySelector("input").classList.add("active-input");
    this.parentElement.querySelectorAll(".my-btn-class").forEach((el) => {
            el.classList.add("active-btns");
        });
        this.classList.add("btns-none");
        this.closest("tr")
            .querySelectorAll(".btn_close_modal")
            .forEach((el) => {
                el.classList.add("btns-none");
            });
            this.closest("tr").querySelector(".tdTxt input").value = this
            .closest("tr")
            .querySelector(".tdTxt span")
            .textContent.trim();
            this.closest("tr").querySelector(".tdTxt span").textContent = "Fb";
}
let changes_result = null;

    // closeBtns.forEach((btn) => {
    //     let started_value = btn
    //         .closest("tr")
    //         .querySelector(".tdTxt span").textContent;

    //     btn.addEventListener("click", (e) => {
    //         btn.parentElement.querySelectorAll(".my-btn-class").forEach((el) => {
    //             el.classList.remove("active-btns");
    //         });
    //         btn.closest("tr")
    //             .querySelectorAll(".btn_close_modal")
    //             .forEach((el) => {
    //                 el.classList.remove("btns-none");
    //             });
    //         editBtn.forEach((el) => {
    //             el.classList.remove("btns-none");
    //         });
    //         btn.closest("tr")
    //             .querySelector("input")
    //             .classList.remove("active-input");

    //         if (changes_result === null) {
    //             btn.closest("tr").querySelector(".tdTxt span").textContent =
    //                 started_value;
    //         } else {
    //             btn.closest("tr").querySelector(".tdTxt span").textContent =
    //                 changes_result;
    //         }

    //     });
    // });

    function closeBtn() {
        
        this.parentElement.querySelectorAll(".my-btn-class").forEach((el) => {
            el.classList.remove("active-btns");
        });
        this.closest("tr")
            .querySelectorAll(".btn_close_modal")
            .forEach((el) => {
                el.classList.remove("btns-none");
            });
        editBtn.forEach((el) => {
            el.classList.remove("btns-none");
        });
        this.closest("tr")
            .querySelector("input")
            .classList.remove("active-input");

        if (changes_result === null) {
            this.closest("tr").querySelector(".tdTxt span").textContent =
                started_value;
        } else {
            this.closest("tr").querySelector(".tdTxt span").textContent =
                changes_result;
        }
    }


subBtns.forEach((btn) => {
    btn.addEventListener("click", SubBtn);
});

function SubBtn() {
    changes_result = this.closest("tr").querySelector("input").value;

        this.closest("tr")
            .querySelector("input")
            .classList.remove("active-input");

        editBtn.forEach((el) => {
            el.classList.remove("btns-none");
        });

        this.closest("tr")
            .querySelectorAll(".btn_close_modal")
            .forEach((el) => {
                el.classList.remove("btns-none");
            });

        this.parentElement.querySelectorAll(".my-btn-class").forEach((el) => {
            el.classList.remove("active-btns");
        });

        // ================================================
        // fetch
        // ================================================

        const tdEditUrl =
            document.getElementById("resizeMe").getAttribute("data-edit-url") +
            this.closest("tr").querySelector(".trId").textContent;

        const newTitle = {
            name: this.closest("tr").querySelector(".tdTxt input").value,
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

                this.closest("tr").querySelector(".tdTxt span").textContent = this
                    .closest("tr")
                    .querySelector(".tdTxt input").value;
            }
        });
} 

// =========================================================================

const myFormAction = document.querySelector(".my-form-class");

const createUrl = document
    .getElementById("resizeMe")
    .getAttribute("data-create-url");


const myOpModal = document.querySelector(".my-opModal");

myOpModal.addEventListener("click", (e) => {
    myFormAction.action = createUrl;
});
