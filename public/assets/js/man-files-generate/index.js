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
// ============================================
//  fetch
// ============================================
async function getFileDataMan(files) {

    const postUrl = '';

    try {
        const response = await fetch(postUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(files),
        });
        if (!response.ok) {
            throw new Error("Network response was not ok");
        } else {
            let response =  await response.json()
            
        }
    } catch (error) {
        console.error("Error:", error);
    }
}
// ============================================
//  fetch end
// ============================================
// ============================================
//  save file btn js
// ============================================
let saveBtn = document.querySelector('.save-file-btn')
function saveFileFunc () {
    let all_checked_input = document.querySelectorAll('.checked-input')
    let arr = []
    all_checked_input.forEach(el => {
        if(el.checked){
            let file_text = el.closest('tr').querySelector('.file-generate-div').innerText
            arr.push(file_text)
        }
    })
    if(arr.length !== 0){
        getFileDataMan(arr)
        console.log(arr);
    }
}
saveBtn.addEventListener('click',saveFileFunc)
// ============================================
//  save file btn js end
// ============================================
