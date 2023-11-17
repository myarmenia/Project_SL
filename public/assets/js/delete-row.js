const myFormAction = document.querySelector(".my-form-class");

const createUrl = document
    .querySelector(".table")
    .getAttribute("data-create-url");

const myOpModal = document.querySelector(".my-opModal");

myOpModal.addEventListener("click", (e) => {
    myFormAction.action = createUrl;
});

document.querySelector(".my-form-class").addEventListener("submit", (e) => {
    e.target.querySelector(".my-class-sub").setAttribute("type", "button");
});

document.querySelector(".my-class-sub").addEventListener("click", (e) => {
    setTimeout(() => {
        e.target.disabled = true;
    }, 10);
});
