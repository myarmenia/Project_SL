
const myFormValid = document.querySelectorAll('.myFormValid')
let arr = []


myFormValid.forEach(input =>{
  input.addEventListener('change', (e)=>{
    let num = Number(e.target.value)
    let maxN = Math.max(...arr)
    const inValid = document.querySelectorAll('.invalid-feedback')
    if(num === 1 && !arr.length){
      arr.push(num)
      e.target.parentElement.nextElementSibling.classList.remove('activeInValid')
    }
    else if(num === maxN + 1){
      arr.push(num)
      e.target.parentElement.nextElementSibling.classList.remove('activeInValid')
    }
    else{
      e.target.value = ''
      e.target.parentElement.nextElementSibling.classList.add('activeInValid')
    }
  })
})
