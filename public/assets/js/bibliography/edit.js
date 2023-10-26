const modalDoc = document.querySelectorAll(".modalDoc");
const modalRightDoc = document.getElementById("modalRightDoc");

modalDoc.forEach((el) => {
    el.addEventListener("click", function () {
        modalRightDoc.style.display = "block";
        modalRightDoc.style.opacity = "1";
        modalRightDoc.style.visibility = "visible";
    });
});
