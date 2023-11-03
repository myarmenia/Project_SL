const modalDoc = document.querySelectorAll(".modalDoc");
const modalRightDoc = document.getElementById("modalRightDoc");

modalDoc.forEach((el) => {
    el.addEventListener("click", function () {
        modalRightDoc.style.display = "block";
        modalRightDoc.style.opacity = "1";
        modalRightDoc.style.visibility = "visible";
    });
});


//modal close btn
const closeBtn = document.getElementById("close_btn");

closeBtn.addEventListener("click", function () {
  modalRightDoc.style.display = "none";
  modalRightDoc.style.opacity = "0";
  modalRightDoc.style.visibility = "hidden";
});