(function () {
  const into_view_wrapper = document.querySelectorAll(".into-view-wrapper");

  into_view_wrapper?.forEach((w) => {
    const div = w?.querySelector(".into-view");
    w.scroll({ behavior: "smooth", top: div.offsetTop });
  });
})();
