// ============================================
// checket input js
// ============================================
let all_checked_input = document.querySelector(".all-checked-input");
let checked_input = document.querySelectorAll(".checked-input");

all_checked_input?.addEventListener("change", (e) => {
    checked_input.forEach((el) => (el.checked = all_checked_input.checked));
});

checked_input.forEach((el) => {
    el.addEventListener("change", () => {
        let bullTrue = 0;
        let bullFalse = 0;
        checked_input.forEach((el) => {
            if (el.checked) {
                bullTrue++;
            } else {
                bullFalse++;
            }
        });
        bullTrue === checked_input.length
            ? (all_checked_input.checked = true)
            : bullFalse === checked_input.length
            ? (all_checked_input.checked = false)
            : bullTrue !== checked_input.length
            ? (all_checked_input.checked = false)
            : "";
    });
});
// ============================================
//  checket input js end
// ============================================