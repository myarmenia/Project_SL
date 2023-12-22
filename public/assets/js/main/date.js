let picker = {};
let element = null
const date_inp_text = document.querySelectorAll('.calendarInput')
function openCalendar(el) {
  element = el.closest('.calendar-container').querySelector('.calendarInput')
  let elementId = element.name

  if (!picker[elementId]) {
    picker[elementId] = new Pikaday({
      field: el,
      format: 'DD-MM-YYYY',
      yearRange: [1900, new Date().getFullYear()],
      onSelect: updateInput
    });
  }
  picker[elementId].show();
}

function handleBlur(inp) {
  const val_rep = inp.value.replace(/[-,/,.]/g, '')
  const val = val_rep.slice(0, 4)
  const end_val = val_rep.slice(4, val_rep.length)
  function addHyphenEveryTwo(val) {
    let chunks = [];
    for (let i = 0; i < val.length; i += 2) {
      chunks.push(val.slice(i, i + 2));
    }
    return chunks.join("-");
  }

  let resultString = addHyphenEveryTwo(val);
  const day = resultString;
  let year = end_val

  let arr_day = day.split('-')
  if (parseInt(year, 10) < 41 && year.length === 2) {
    year = '20' + year;
    const formattedDate = `${day}-${year}`;
    inp.value = formattedDate.split('-').reverse().join('-');
  }

  else if (parseInt(year, 10) > 41 && year.length === 2) {
    year = '19' + year;
    const formattedDate = `${day}-${year}`;
    inp.value = formattedDate.split('-').reverse().join('-');
    console.log(formattedDate);

  }

  else{
    const formattedDate = `${day}-${year}`;
    inp.value = formattedDate.split('-').reverse().join('-');
  }

  if (year.length !== 4) {
    inp.value = ''
  }

  if (val_rep.length < 6) {
    inp.value = ''
  }

  if (+arr_day[0] > 31) {
    inp.value = ''
  }

  if (+arr_day[1] > 12) {
    inp.value = ''
  }

 if (inp.closest('form')){
     reverseInput(inp)
 }
console.log(inp.value);
}

function reverseInput(el){
    let elVal = el.value.split(' ')
    el.value = elVal[0].split('-').reverse().join('-')
}

function updateInput(date) {
  const day = date.getDate().toString().padStart(2, '0');
  const month = (date.getMonth() + 1).toString().padStart(2, '0'); // Months are zero-based
  const year = date.getFullYear().toString();
  element.value = `${day}-${month}-${year}`
  element.focus()
}

function handleInput() {
  date_inp_text.forEach((el) => {

    let elVal = el.value.split(' ')
    el.value = elVal[0].split('-').reverse().join('-')

    const parentEl = el.closest('.col')

    if (parentEl && parentEl.querySelector('input').disabled){
        parentEl.querySelector('.calendar-icon').classList.add('disabled')
    }

    el.addEventListener('input', (e) => {
      let regex = /[^a-zA-Z]/;
      if (!regex.test(e.target.value)) {
        el.value = ''
      }
    });
  });
}

handleInput()
