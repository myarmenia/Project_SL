const modalDoc = document.querySelectorAll(".modalDoc");
const modalRightDoc = document.getElementById("modalRightDoc");

modalDoc.forEach((el) => {
    el.addEventListener("click", function () {
        document.getElementById('paragraph_info').innerHTML='';
        let manInfo=el.getAttribute('data-info')

        const requestOption = {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(manInfo)
        }

        fetch('/'+lang+'/bibliography-man-paragraph', requestOption)
        .then(async res => {
            if (!res) {
                console.log('error');
            }
            else {
                const data = await res.json()
                console.log(data.result);


                if(data.result){

                    const result_object = data.result

                        document.getElementById('paragraph_info').innerHTML=result_object


                }
            }
        })

        modalRightDoc.style.display = "block";
        modalRightDoc.style.opacity = "1";
        modalRightDoc.style.visibility = "visible";

    });

});

//modal close btn
const closeBtn = document.getElementById("close_btn");

closeBtn.addEventListener("click", function () {
  modalRightDoc.style.display = "none";
  modalRightDoc.style.opacity = "0";
  modalRightDoc.style.visibility = "hidden";
});


//scroll to center blue text ---?

  let modalDiv = document.getElementById(".paragraph_info");
    let pElementAll = document.querySelectorAll(".centered-text");
    pElementAll.forEach(function (el) {
        let containerMidpoint = modalDiv.clientHeight / 2;
        let elementMidpoint = el.clientHeight / 2;
        modalDiv.scrollTop = el.offsetTop - containerMidpoint + elementMidpoint;
    });
