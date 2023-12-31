console.log(223344)
function drowTr(newTr, key, model_name) {
    const tr = document.createElement("tr");
    const td1 = document.createElement("td");
    td1.innerText = key;
    td1.classList.add("modelId");
    tr.append(td1);

    const td2 = document.createElement("td");

    td2.innerText = newTr;
    td2.setAttribute("data-model", model_name);
    td2.classList.add("inputName");
    tr.append(td2);
    const td3 = document.createElement("td");
    const btn = document.createElement("button");
    btn.textContent = "Ավելացնել";
    btn.classList.add("addInputTxt");
    btn.classList.add("btn-primary");
    btn.classList.add("btn");
    btn.setAttribute("data-id", 1);
    btn.setAttribute("data-bs-dismiss", "modal");
    btn.setAttribute("aria-label", "Close");
    td3.append(btn);
    tr.append(td3);

    return tr;
}

const modal_info_btn = document.getElementById("addNewInfoBtn"); //  Find the element
modal_info_btn.onsubmit = fetchInfo; // Add onsubmit function to element

function fetchInfo(obj) {
    obj.preventDefault();
    const addNewInfoBtn_modal = document.getElementById("addNewInfoBtn");
    const addNewInfoInp = document.getElementById("addNewInfoInp");
    const table_name = addNewInfoInp.getAttribute("data-table-name");

    const newBody = {
        value: addNewInfoInp.value,
        fieldName: addNewInfoInp.name,
        table_name: table_name,
    };

    const requestOption = {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(newBody),
    };

    fetch("/" + lang + "/create-table-field", requestOption).then(
        async (res) => {
            if (!res) {
                // console.log('error');
            } else {
                const data = await res.json();
                const result_object = data.result;
                const model_name = data.model_name;
                document.getElementById("table_id").innerHTML = "";
                const objMap = new Map(Object.entries(result_object));
                objMap.forEach((item, key) => {
                    document
                        .getElementById("table_id")
                        .append(drowTr(item.name, item.id, model_name));
                });

                append_data();
                document.getElementById("addNewInfoInp").value = "";
            }
        }
    );
}

// ================oninput=========================================================================================
// transfer plus button  as obj working  filter in modal
const modal_filter = document.getElementById("addNewInfoInp"); //  Find the element
modal_filter.oninput = fetchInfoInputEvent; // Add oninput function to element

function fetchInfoInputEvent(e) {
    const table_name = document
        .getElementById("addNewInfoInp")
        .getAttribute("data-table-name");
    const addNewInfoInp = document.getElementById("addNewInfoInp");
    e.preventDefault();

    const requestOption = {
        method: "get",
        headers: { "Content-Type": "application/json" },
    };

    fetch(
        get_filter_in_modal +
            "?path=" +
            table_name +
            "&name=" +
            addNewInfoInp.value,
        requestOption
    ).then(async (res) => {
        if (!res) {
            console.log("error");
        } else {
            const data = await res.json();
            document.getElementById("table_id").innerHTML = "";

            if (data.result) {
                const result_object = data.result;
                const model_name = data.model_name;

                result_object.forEach((element) => {
                    document
                        .getElementById("table_id")
                        .append(drowTr(element.name, element.id, model_name));
                });
                append_data();
            }
        }
    });
}

const plusIcon = document.querySelectorAll(".my-plus-class");
const addInputTxt = document.querySelectorAll(".addInputTxt");
const modal = document.querySelector(".modal");
let plusBtn;
plusIcon.forEach((plus) => {
    plus.addEventListener("click", openModal);
});

console.log('ppppppppppp')
function openModal() {
    console.log(333)
    plusBtn = this
    // ============== im grac mas start ===============
    document.getElementById("addNewInfoInp").value = "";
    document.getElementById("table_id").innerHTML = "";
    const fieldname_db = this.getAttribute("data-fieldname");
    const get_table_name = this.getAttribute("data-table-name");
    document
        .getElementById("addNewInfoInp")
        .setAttribute("data-table-name", get_table_name);

    console.log(get_table_name + "+ic bacvox ");
    const newBody = {
        table_name: get_table_name,
    };

    // console.log(newBody);
    const requestOption = {
        method: "GET",
        headers: { "Content-Type": "application/json" },
    };
    // get open_modal_url variable  from blade script to get table content
    fetch(open_modal_url + "?table_name=" + get_table_name, requestOption).then(
        async (res) => {
            if (!res) {
                console.log("error");
                //   const validation = await res.json()
            }
            else {
                const data = await res.json()
                const result_object = data.result
                const model_name = data.model_name
console.log(result_object)
                // every time on open modal we clean input value
                document.getElementById("addNewInfoInp").value = "";
                // getting object value and in map creating tr
                let objMap = new Map(Object.entries(result_object));
                document.getElementById("table_id").innerHTML = "";

                objMap.forEach((item) => {
                    document
                        .getElementById("table_id")
                        .append(
                            drowTr(item[fieldname_db], item.id, model_name)
                        );
                });
                // calling  append_data function and transfer this  which is plus button

                append_data();
            }
        }
    );
}

function handleClick() {
    this.setAttribute("data-bs-dismiss", "modal");
    const get_table_name = document
        .getElementById("addNewInfoInp")
        .getAttribute("data-table-name");
    const input = plusBtn
        .closest(".forForm")
        .querySelector(".oneInputSaveEnter");
    const text_content =
        this.closest("tr").querySelector(".inputName").textContent;
    const model_id = this.closest("tr").querySelector(".modelId").textContent;
    const model_name = this.closest("tr")
        .querySelector(".inputName")
        .getAttribute("data-model");

    if (input.classList.contains("set_value")) {
        input.closest(".form-floating").querySelector(".main_value").value =
            model_id;
    }

    input.value = text_content;
    input.focus();
    input.setAttribute("data-modelid", model_id);
    input.setAttribute("data-modelname", model_name);

    if (input.hasAttribute("datainputid")) {
        let hiddenId = input.getAttribute("datainputid");
        console.log(hiddenId);
        document.getElementById(hiddenId).value = model_id;
    }
}

// separate function for appendin  object
function append_data() {
    document.querySelectorAll(".addInputTxt").forEach((el) => {
        el.addEventListener("click", handleClick);
    });

    document
        .getElementById("table_id")
        .querySelectorAll("tr")
        .forEach((el) => {
            el.addEventListener("dblclick", (e) => {
                e.target.closest("tr").querySelector(".addInputTxt").click();
            });
        });
}

const fetch_input_title = document.querySelectorAll(".fetch_input_title");

fetch_input_title.forEach((el) => {
    el.addEventListener("input", (e) => {
        if (!el.value) {
            el.value = "";
        }
        fetchInputTitle(el);
    });

    el.addEventListener("focus", (e) => {
        fetchInputTitle(el);
    });
});

//   // ====== work with datalist
const append_datalist_info = document.querySelectorAll(".get_datalist");

append_datalist_info.forEach((inp) => {
    inp.addEventListener("change", (e) => {
        let thisVal = inp.value;
        let datalist_id = inp.getAttribute("list");
        let dataId = inp
            .closest(".col")
            .querySelector(".my-plus-class")
            .getAttribute("data-table-name");
        const opts = document.getElementById(datalist_id).childNodes;
        const parent = inp.closest(".forForm");

        for (var i = 0; i < opts.length; i++) {
            if (opts[i].value === thisVal) {
                let p = opts[i].getAttribute("data-modelid");

                inp.setAttribute("data-modelid", p);
                inp.setAttribute("data-modelname", dataId);

                if (
                    parent
                        .querySelector(".fetch_input_title")
                        .hasAttribute("dataInputId")
                ) {
                    // console.log(552233)
                    let hiddenId = parent
                        .querySelector(".fetch_input_title")
                        .getAttribute("dataInputId");
                    document.getElementById(hiddenId).value = p;
                }

                break;
            }
        }
    });
});

//===========================

function fetchInputTitle(el) {
    console.log(11111)
    const get_table_name = el
        .closest(".forForm")
        .querySelector(".my-plus-class")
        .getAttribute("data-table-name");
    const parent = el.closest(".forForm");

    if (
        parent.querySelector(".fetch_input_title").hasAttribute("datainputid")
    ) {
        let hiddenId = parent
            .querySelector(".fetch_input_title")
            .getAttribute("datainputid");
        document.getElementById(hiddenId).value = "";
    }

    const url = get_filter_in_modal + "?path=" + get_table_name;

    const newTitle = {
        name: el.value,
    };
    if (url) {
        const requestOption = {
            method: "GET",
            headers: { "Content-Type": "application/json" },
        };

        fetch(url + "&name=" + el.value, requestOption).then(async (res) => {
            if (!res.ok) {
                // const message = await res.json()
                // const objMap = new Map(Object.entries(message.errors));
                // objMap.forEach((item) => {
                //     item.forEach(el => errorModal(el))
                // })
                el.value = "";
            } else {
                const data = await res.json();
                const result = data.result;

                el.closest(".forForm").querySelector("datalist").innerHTML = "";

                result.forEach((element) => {
                    const option = document.createElement("option");
                    option.innerText = element.name;
                    option.setAttribute("data-modelid", element.id);
                    el.closest(".forForm")
                        .querySelector("datalist")
                        .appendChild(option);
                });
            }
        });
    }
}
