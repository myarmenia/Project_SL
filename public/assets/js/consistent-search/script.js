function drowTableTr(id, txt, man ) {
    const tr = document.createElement('tr')
    const td1 = document.createElement('td')
    td1.innerText = id
    td1.classList.add('modelId')
    tr.append(td1)

    const td2 = document.createElement('td')

    td2.innerText = txt
    td2.classList.add('inputName')
    tr.append(td2)
    const td3 = document.createElement('td')
    td3.innerText = man
    tr.append(td3)
    const td4 = document.createElement('td')
    td4.innerHTML = `<i class="bi bi-trash3"></i>`
    tr.append(td4)

    return tr
}

const form = document.querySelector('.consistent-form')

const input = document.querySelectorAll('.save_input_data')

form.addEventListener('submit', (e)=>{
    e.preventDefault()
    const newInfo = {
        txt: input[0].value,
        man: input[1].value
    }
    
    const requestOption = {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(newInfo)
    }

        fetch(URL, requestOption)
            .then(async res => {
                if (!res.ok) {
                   console.log('error');
                    
                }
                else {
                    const data = await res.json()
                    const result = data.result
                    
                    result.forEach(el => {
                        document.querySelector('.tbody').prepend(drowTableTr(el.id, el.txt, el.man))
                    });
                }
                
            })
            // document.querySelector('.tbody').prepend(drowTableTr('1', 'nkar2', 'Eskobar'))
})