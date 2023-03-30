const search_bar2 = document.getElementById("search-bar2");
const categories = document.getElementById("categories");

window.addEventListener("scroll", () => {
  scrollPosition = window.scrollY;
  console.log(scrollPosition);
  if (scrollPosition > convertRemToPixels((12 + 4) / 2)) {
    search_bar2.classList.add("show");
  } else {
    search_bar2.classList.remove("show");
  }
});

function convertRemToPixels(rem) {
  return rem * parseFloat(getComputedStyle(document.documentElement).fontSize);
}
