// isActive notActive js // 

const allRangeInp = document.querySelectorAll(".rangeInput");
allRangeInp.forEach((el) => {
  el.addEventListener("change", (e) => {
    let cancel = document.querySelector("#cancel_btn");
    let confirm = document.querySelector("#isActive_button")

    cancel.onclick = () => {
      if (e.target.value === "1") {
        e.target.value = 0;
      } else if (e.target.value === "0") {
        e.target.value = 1;
      }
    };
    
    confirm.onclick = () => {
      let statusForm = document.querySelector('#status_form')
      let dataId = e.target.closest('tr').getAttribute('data-id')
      statusForm.action = `aaa/url/${dataId}`
    }
  });
});