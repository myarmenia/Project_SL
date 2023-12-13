let btns = document.querySelectorAll(".btns");
btns.forEach((el) => {
    el.addEventListener("click", () => {
        let status = el.name;
        fetch(button_generate_file, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ status }),
        })

            .then(  async data => {

                let result =  await data.json()
                console.log(result)
                if(result.message == 'No_persons_with_such_status_were_found_in_the_base'){
                    errorModal(no_persons_with_such_status_were_found_in_the_base)
                }else{
                    let downloadTeg="<a href=/"+lang+"/download?path="+result.message+" id='parag_file' >download</a>"
                    document.getElementById('downloaded_file').innerHTML=downloadTeg
                    document.getElementById('parag_file').click()
                }




            })
            .catch((error) => {
                console.log("Произошла ошибка", error);
            });
    });
});

let radioBtns = document.querySelectorAll(".radioBtns");
radioBtns.forEach((el) => {
    el.addEventListener("click", () => {
        console.log(el.value);
        ElVal = el.value;
        console.log(el.id);

        ElId = el.getAttribute('data-id');
        console.log(ElId);

        fetch(update_checked_user_list, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                status: ElVal,
                user_id: ElId,
            }),
        })
            // .then((response) => response.json())
            .then((data) => {
                console.log("data", data);
            })
            .catch((error) => {
                console.log("Произошла ошибка", error);
            });
    });
});
