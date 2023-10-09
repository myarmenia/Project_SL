const formControl = document.querySelectorAll('.form-control')

const tegs = document.querySelectorAll('.Myteg span:nth-of-type(1)')

formControl.forEach(input => {
    input.addEventListener('blur', onBlur)
})

function onBlur() {
    let newInfo = {}
    if (this.classList.contains('intermediate')) {

    } else {
        if (this.closest('.form-floating').querySelector('.my-plus-class')) {
            fetchInputTitle(this)
        }

        if (this.value) {
            let newInfo = {};
            if (this.hasAttribute('data-modelid')) {
                const get_model_id = this.getAttribute('data-modelid')

                newInfo.intermediate = 1
            } else {
                newInfo = {
                    ...newInfo,
                    value: this.value,
                    fieldName: this.name
                }
            }
        }
    }
    fetQuery(this.value, newInfo)
}

function fetQuery(value, newInfo) {
    console.info(newInfo)
    if (value) {
        const newurl = document.getElementById('updated_route').value
        const requestOption = {
            method: 'PATCH',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(newInfo)
        }

        fetch(newurl, requestOption)
            .then(async res => {
                if (!res) {
                    console.log('error');
                } else {
                    const data = await res.json()
                    const result = data.message
                    console.log(result)
                }
            })
    }
}
