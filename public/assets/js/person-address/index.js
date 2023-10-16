
let districtInput = document.querySelector(".district_isActive_notActive")
let addressInput = document.querySelector(".address_isActive_notActive")
const notActiv_district = document.querySelectorAll(".notActiv_district");
const notActive_address = document.querySelectorAll(".notActive_address");
const notActiveIcons = document.querySelectorAll(".not_active")
function districtInputChange() {
    notActiv_district.forEach((el) => {
        el.setAttribute("disabled",'')
    })
    notActiveIcons.forEach(el => {
        el.setAttribute("data-bs-target","#fullscreenModal")
    })
    if(districtInput.getAttribute('checked') === null){
        notActive_address.forEach((el) => {
            el.removeAttribute("disabled");
        });
    }
   
      
}
districtInputChange();
districtInput.addEventListener('change',districtInputChange)
function addressInputChange() {
    districtInput.removeAttribute('checked')
    notActive_address.forEach((el) => {
        el.setAttribute("disabled",'')
    })
    notActiv_district.forEach((el) => {
        el.removeAttribute("disabled");
    });
    notActiveIcons.forEach(el => {
        el.removeAttribute('data-bs-target')
    })
}
addressInput.addEventListener('change',addressInputChange)