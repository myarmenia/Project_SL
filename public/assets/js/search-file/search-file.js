// ============================================
// file generate fetch
// ============================================

async function getFileData(files) {

    const postUrl = generate_file;

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
            let loader = document.body.querySelector('#loader-wrapper')
            loader?.remove()
            errorModal(answer_message)
            clearCheckedInput()
        }
    } catch (error) {
        console.error("Error:", error);
    }
}

// ============================================
// file generate fetch end
// ============================================
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
// show file text js
// ============================================

let show_file_text = document.querySelectorAll(".show-file-text");
show_file_text.forEach((icon) =>
    icon.addEventListener("click", (e) => {
        let file_text = e.target.querySelector("p").innerHTML;
        let file_infon = e.target
            .closest("tr")
            .querySelector(".file_info").innerText;
        let show_file_modal = document.querySelector(".show-file-modal");
        let modal_title = show_file_modal.querySelector(".modal-title");
        let modal_body = show_file_modal.querySelector(".modal-body");
        modal_title.innerText = file_infon;
        modal_body.innerHTML = file_text;
    })
);

// ============================================
// show file text js end
// ============================================


// ============================================
// save files js
// ============================================

// ============================================
// search files js
// ============================================
let search_file_btn = document.querySelector(".search-file-btn");
let p = document.querySelector(".search-word");
search_file_btn.addEventListener("click", () => {
    let input = document.getElementById("search_input");
    p.innerText = input.value;
});
// ============================================
// search files js end
// ============================================

let save_file_btn = document.querySelector(".save-file-btn");

function saveFunction() {
    showLoaderFIle()
    let allCheckedInput = document.querySelectorAll(".checked-input");
    let search_word = document.querySelector(".search-word");
    let textsArr = [];
    allCheckedInput.forEach((el) => {
        if (el.checked) {
            let generate_text = el.closest('tr').querySelector('.file-generate-div').innerText;
            let reg_date = el.closest('tr').querySelector('.reg-date').innerText
            let objArr = {
                reg_date:reg_date,
                text:generate_text
            }
            textsArr.push(objArr);
        }
    });
    let obj = {
        search_word: search_word.innerText,
        files_data: textsArr,
    };
    console.log(obj);
    getFileData(obj);
}

save_file_btn?.addEventListener("click", () => saveFunction());

// ============================================
// save files js end
// ============================================

// ============================================
// search-file-modal btn js
// ============================================
function clearCheckedInput (){
    let search_file_modal_btn = document.querySelector('.search-file-modal')
    search_file_modal_btn?.addEventListener('click' , () => {
        all_checked_input.checked = false
        checked_input.forEach(el => el.checked = false)
    })
}

// ============================================
// search-file-modal btn js end
// ============================================

function showLoaderFIle (){
    let loader_wrapper = document.createElement('div')
    loader_wrapper.id = "loader-wrapper"
    let loader = document.createElement('div')
    loader.id = "loader"
    loader_wrapper.appendChild(loader)
    document.body.appendChild(loader_wrapper)
}


