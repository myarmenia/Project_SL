let firstInputs = document.querySelectorAll('.id-input')
firstInputs.forEach(el => {
    el.addEventListener('input', (e) => {
        console.log(+e.target.value);
        
        if(isNaN(+e.target.value) || e.target.value === ''){
            e.target.value = ''
        }
    })
})

// const button = document.getElementById("myButton");
// const loadingIndicator = document.getElementById("loadingIndicator");

// button.addEventListener("click", function() {
//   loadingIndicator.style.display = "block";
//   setTimeout(function() {
//     loadingIndicator.style.display = "none";
//   }, 2000); 
// });
