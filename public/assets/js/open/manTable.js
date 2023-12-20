const block = document.getElementById("searchBlock");
const allI = document.querySelectorAll(".filter-th i");
let page = 1;
const perPage = 10;
let lastScrollPosition = 0;
let sc_name = document
    .querySelector(".table")
    ?.getAttribute("data-section-name");
let tb_name = document.querySelector(".table")?.getAttribute("data-table-name");
let man_search_inputs = document.querySelectorAll(
    ".man-search-inputs div .man-search-input"
);
let full_name_input = document.querySelector(".full-name-input");
let id_filter_input = document.querySelector(".id-filter-input");
let search_input_btn = document.querySelector(".search-input-btn");