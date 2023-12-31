const myFormValid = document.querySelectorAll(".myFormValid");

let arr = [];
let num = 1;
let columnIndex = null;
let maxN = null;
let change = false;
let index = null
let arrValue = []

function addColumNumber(e) {
    let columNumber = +e.target.value;
    const inValid = document.querySelectorAll(".invalid-feedback");

    if (arrValue[0] && arr.includes(arrValue[0])) {
        columnIndex = arr.indexOf(arrValue[0]);
        arr.splice(columnIndex, 1);
        arrValue = []
  }
 
    if (arr.length !== 0) {
        maxN = Math.max(...arr);
    }

    if (columNumber === 1 && arr.length === 0) {
        arr.push(columNumber);
        e.target.parentElement.nextElementSibling.classList.remove(
            "activeInValid"
        );
    } else {

        if (arr.includes(1)) {
            if (arr.length > 1) {
            
           function testChange (x){
            for (let i = 0; i < x.length - 1; i++) {
                if (x[i + 1] - x[i] !== num) {
                    index = i
                    return change = false
                }
                }
                return change = true
         }
         
         testChange (arr)
         if(change === true && columNumber === maxN + 1){
            arr.push(columNumber);
         }else if (change === false && columNumber === arr[index] + 1){
            arr.splice(index + 1, 0, columNumber);
        }else {
                if(!arr.includes(+e.target.value)){
                    e.target.value = ""
                }      
         }
               
            } else {
                if (columNumber === maxN + 1  ) {
                    arr.push(columNumber);
                } else if (!change) {
                    e.target.value = "";             
                }
                
            }
        } else if (columNumber === 1) {
            arr.unshift(1);
        } else { 
            e.target.value = "";
        }
        
    }
   
}

function testValue(e) {
    if (e.key === "Backspace") {
        let inputs = document.querySelectorAll('.myFormValid')
        let bul = true
        inputs.forEach(el => {
            if(el.value === e.target.value){
                bul = false
            }
        })
        if(bul){
            arrValue = []
            arrValue.push(+e.target.value)
        }
       
    }
}

function testInput (e) {   
    let val = +e.target.value
        if (arr && arr.includes(val)){
            e.target.value = "";
        }  
}


myFormValid.forEach((input) => {
    input.addEventListener("blur", (e) => addColumNumber(e));
    input.addEventListener("keydown", (event) => testValue(event));
    input.addEventListener('change', (e) => testInput(e))
});



const file = document.getElementById('file_id')

file.addEventListener('change',(e) => {
    document.querySelector('.file-name').textContent = file.files[0].name
})

///////////////////////////////////loader bootstrap //////////////

function showLoaderFIle() {
      let loader_wrapper = document.createElement("div");
      loader_wrapper.id = "loader-wrapper";
      let loader = document.createElement("div");
      loader.id = "loader";
      loader_wrapper.appendChild(loader);
      document.body.appendChild(loader_wrapper);
}

/* /////////////// end loader bootstrap /////////////// */