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
            // .then((response) => response.json())
            .then((data) => {
                console.log("data", data);
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
        ElId = el.id;
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
