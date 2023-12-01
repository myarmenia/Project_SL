

// ===================== fetch post file =====================  //

const apiUrl = "https://jsonplaceholder.typicode.com/posts";

function postFile(requestData) {

    fetch(apiUrl, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(requestData),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then((data) => {
            console.log(data);
        })
        .catch((error) => {
            console.error("Fetch error:", error);
        });
    closeFuncton();
}

// const formControl = document.querySelectorAll('.form-control')

const tegs = document.querySelectorAll('.Myteg span:nth-of-type(1)')


document.querySelector('.file-upload')?.addEventListener('change', function (data) {
    const apiUrl = this.getAttribute('data-name')
    const formData = new FormData();

    formData.append('value', data.target.files[0]);
    formData.append('_method', 'PUT');
    formData.append('type', this.getAttribute('data-type'));
    formData.append('fieldName', 'file');
    let message

    fetch(apiUrl, {
        method: "POST",
        body: formData,
    })
    .then(async (response) => {
        message = await response.json()
        const pivot_table_name = this.getAttribute('data-pivot-table')
        const field_name = this.getAttribute('data-fieldname')
        const tegsDiv = this.closest('.col').querySelector('.tegs-div')

        tegsDiv.innerHTML += drowTeg(parent_id, pivot_table_name, message.result, field_name)
    }).finally(() => {
        DelItem()
    })
})

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


const fullName = document.getElementById('fullName');

const inpClass = document.querySelectorAll('.my-teg-class');

function getFullName(inp) {
    fetch('/' + lang + '/man/' + parent_id + '/full_name')
        .then(async res => {
            if (!res.ok) {
                console.log('error');
                inp.value = ''
            } else {
                const data = await res.json()
                fullName.value = data.result
                inp.value = ''
            }
        })
}

inpClass.forEach(inp => {
    inp.addEventListener('blur', (e) => {

        if (inp.value) {
            setTimeout(getFullName(inp), 0)

            fetch('/' + lang + '/man/' + parent_id + '/full_name')
                .then(async res => {
                    if (!res.ok) {
                       console.log('error');
                        inp.value = ''
                    }
                    else {
                        const data = await res.json()
                        const result = data.result
                        fullName.value =  result
                        inp.value = ''
                    }
                })
        }
    });
});




