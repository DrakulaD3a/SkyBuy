const search_bar = document.getElementById("search-bar");
const search_bar2 = document.getElementById("search-bar2");
const categories_wrapper = document.getElementById("categories-wrapper");
const filters = document.getElementById("filters");

window.addEventListener("scroll", () => {
  let marginTop;

  if (scrollY >= convertRemToPixels((12 + 4) / 2)) {
    marginTop = scrollY - convertRemToPixels((12 + 4) / 2);

    search_bar.classList.add("hide");
    search_bar2.classList.add("show");
  } else {
    marginTop = convertRemToPixels(1);

    search_bar.classList.remove("hide");
    search_bar2.classList.remove("show");
  }

  categories_wrapper.style.marginTop = `${marginTop}px`;
  filters.style.marginTop = `${marginTop <= convertRemToPixels(1) ? marginTop : marginTop + convertRemToPixels(4)}px`;
});

function convertRemToPixels(rem) {
  return rem * parseFloat(getComputedStyle(document.documentElement).fontSize);
}
