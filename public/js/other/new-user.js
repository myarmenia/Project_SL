(function () {
  const inputNanme4 = document.querySelector("#inputNanme4");
  const inputLastNanme4 = document.querySelector("#inputLastNanme4");
  const inputMiddleName = document.querySelector("#inputMiddleName");
  const fullName = document.querySelector("#fullName");

  [inputLastNanme4, inputNanme4, inputMiddleName].forEach((input, i) => {
    input.addEventListener("input", (e) => {
      let new_value = fullName?.value?.split(" ");
      new_value[i] = e.target?.value;
      Input.for(fullName).set(new_value.join(" "));

      if (
        [inputLastNanme4, inputNanme4, inputMiddleName].every((i) => !i?.value)
      ) {
        Input.for(fullName).set("").toggle("close");
      }
    });
  });
})();
