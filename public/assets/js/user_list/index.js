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
                let responce =  await data.json()
                if(responce.message=='file_has_been_generated'){
                    // get answer_message variable from user-list.index
                    errorModal(answer_message)
                }else if(responce.message=='response_file_not_generated'){
                    errorModal(response_file_not_generated)
                }
                else{
                    console.log(responce.message);
                    // show validation error
                    const objMap = new Map(Object.entries(responce.message));
                    objMap.forEach((item) => {
                        item.forEach(el => errorModal(el))
                    })

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
