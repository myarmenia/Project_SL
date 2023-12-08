document.addEventListener("DOMContentLoaded", (e) => {
    let grid_fusion_btn = document.querySelector(".k-grid-fusion");
    grid_fusion_btn.addEventListener("click", (e) => fusionFunc(e));
    let data = '';
    function fusionFunc(e) {
        let arr = [];
        e.preventDefault();
        let checked_inputs = document.querySelectorAll(
            ".fusion-checkbox-input"
        );
        let tb_name = document
            .querySelector(".details")
            .getAttribute("data-tb-name");
        checked_inputs.forEach((el) => {
            if (el.checked) {
                let obj = {
                    id: el.getAttribute('data-id'),
                };
                arr.push(obj);
            }
        });
        let data = {
            all_fusion_id: arr,
            tb_name: tb_name,
        };

        console.log(data);
        postDataFusion(data)
    }

    // --------------------- fetch post data ----------------- //

    async function postDataFusion(data) {
        const postUrl = "/" + lang + "/fusion/fusion-more-ids";
        try {
            const response = await fetch(postUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            });

            if (!response.ok) {
                throw new Error("Network response was not ok");
            } else {
                // const responseData = await response.json();
                // showContactDiv(responseData.data, propsData, typeAction, rowTitle);
            }
        } catch (error) {
            console.error("Error:", error);
        }
    }

    // --------------------- fetch post end ------------------ //

});
