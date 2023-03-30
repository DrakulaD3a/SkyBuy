
const search_bar = document.getElementById("search-bar");
const search_bar2 = document.getElementById("search-bar2");
const categories_wrapper = document.getElementById("categories-wrapper");
const filters = document.getElementById("filters");
const logo = document.getElementById("filters-logo");
const filters_inside = document.getElementById("filters-inside");

window.addEventListener("scroll", () => {
  let marginTop;

  if (scrollY >= convertRemToPixels((12 + 4) / 2)) {
    marginTop = scrollY - convertRemToPixels((12 + 4) / 2);

    search_bar.classList.add("hidden");
    search_bar2.classList.add("show");
    logo.classList.add("show");
    filters_inside.classList.add("hidden");
  } else {
    marginTop = convertRemToPixels(1);

    search_bar.classList.remove("hidden");
    search_bar2.classList.remove("show");
    logo.classList.remove("show");
    filters_inside.classList.remove("hidden");
  }

  categories_wrapper.style.marginTop = `${marginTop}px`;
  filters.style.marginTop = `${marginTop <= convertRemToPixels(1) ? marginTop : marginTop + convertRemToPixels(4)}px`;
});

function convertRemToPixels(rem) {
  return rem * parseFloat(getComputedStyle(document.documentElement).fontSize);
}
