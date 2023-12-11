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

    const postUrl = man_attached_paragraph;

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

            let result =  await response.json()
            console.log(result.message)
            if(result.message!=='response file not generated'){
                let downloadTeg="<a href=/"+lang+"/download?path="+result.message+" id='parag_file' >download</a>"
                document.getElementById('downloaded_file').innerHTML=downloadTeg
                document.getElementById('parag_file').click()
                errorModal(answer_message)
                setTimeout(() => {
                    window.location.reload()
                },3000)

            }else{
                errorModal(response_file_not_generated)
            }


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
console.log(man_id);
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
        let obj = {
            manId : man_id,
            paragraphs : arr
        }
        getFileDataMan(obj)
        console.log(obj);
    }
}
saveBtn.addEventListener('click',saveFileFunc)
// ============================================
//  save file btn js end
// ============================================


