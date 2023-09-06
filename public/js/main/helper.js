const MY_EVENTS = {
  change: "Ev1-change",
};

function genId(length = 7) {
  const word =
    "qwertyuiop_asdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNMйцукенгшщзфывапролджячсмитьбюё1234567890-=.";
  let id = "";
  for (let i = 0; i < length; i++) {
    id += word[Math.floor(Math.random() * word.length)];
  }
  return id;
}

(function () {
  // absolute disabling inputs
  document.querySelectorAll(".d").forEach((elem) => {
    ["click", "input", "change"].forEach((eventType) => {
      elem.addEventListener(eventType, (e) => {
        e.preventDefault();
        return false;
      });
    });
  });

  // Closing sidebar by clicking outside of the itself
  document.querySelector("main").addEventListener("click", (e) => {
    const sidebar = document.querySelector("#sidebar.sidebar");
    const matches = window.matchMedia("(max-width: 1200px)").matches;
    if (
      document.body.classList.contains("toggle-sidebar") &&
      !sidebar.contains(e.target) &&
      matches
    ) {
      document.body.classList.remove("toggle-sidebar");
    }
  });
})();
