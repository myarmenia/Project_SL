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

//////////--------hashvetvutyan dateri avelacum ------////////////
document.getElementById('mySelect').addEventListener('change', function() {
  var selectedOption = this.options[this.selectedIndex];

  if (selectedOption.id === 'option_other') {
      document.getElementById('otherInput').style.display = 'block';
      document.getElementById('otherInput2').style.display = 'block';
      document.getElementById('line').style.display = 'block';
      document.getElementById('select2').style.display = 'none';

  } else {
      document.getElementById('otherInput').style.display = 'none';
      document.getElementById('otherInput2').style.display = 'none';
      document.getElementById('line').style.display = 'none';
      document.getElementById('select2').style.display = 'block';
  }
});


//////---vercuma date-i valuen --- ///////

// document.getElementById('otherInput').addEventListener('change', function () {
//   var selectedDate = this.value;
//   console.log('Выбранная дата:', selectedDate);
// });