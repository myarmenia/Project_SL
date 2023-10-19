let monthSelect = document.querySelector('.month-select')

let yearSelect = document.querySelector('.year-select')

let reportBtn = document.querySelector('.report-button')

let startYear = 1990;
let endYear = new Date().getFullYear();

for (let year = endYear; year >= startYear; year--) {
    let option  = document.createElement('option')
    option.innerText = year
    yearSelect.appendChild(option)
}

function printReport(){
 console.log(monthSelect.value);
 console.log(yearSelect.value);
}

reportBtn.addEventListener('click',printReport)

