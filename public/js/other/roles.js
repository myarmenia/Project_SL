(function () {
  const groups = document.querySelectorAll("#groups > .group");
  const btns = document.querySelectorAll("#groups > .group .btn");
  const group_content = document.querySelectorAll(".group-content .card");
  const add_btn = document.querySelector("#add-new-btn");
  const new_card = document.querySelector(".new-card");
  const tables = document.querySelectorAll("#groups > .group .card");

  groups.forEach((group) => {
    group.addEventListener("mouseenter", (e) => {
      const parent = e.target.closest(".group");
      const table = parent.querySelector(".card");
      groups.forEach((el) => {
        el.classList.remove("show");
      });

      parent.classList.add("show");
      const { width, left, right } = table.getBoundingClientRect();
      if (left + width >= window.innerWidth) {
        table.style.right = "0px";
      }
    });
    group.addEventListener("mouseleave", (e) => {
      const parent = e.target.closest(".group");
      const table = parent.querySelector(".card");
      groups.forEach((el) => {
        el.classList.remove("show");
      });
    });

    group.querySelector(".btn").addEventListener("click", (e) => {
      const id = e.target.getAttribute("data-btn");
      const target = document.querySelector(`[data-target="${id}"]`);
      console.log(target);

      group_content.forEach((el) => {
        el.classList.remove("show");
      });
      btns.forEach((el) => {
        el.classList.remove("active");
      });
      target.classList.add("show");
      e.target.classList.add("active");
    });
  });

  add_btn.addEventListener("click", (e) => {
    groups.forEach((el) => {
      el.querySelector(".btn").classList.remove("active");
    });
    group_content.forEach((el) => {
      el.classList.remove("show");
    });
    new_card.classList.add("show");
  });
})();
