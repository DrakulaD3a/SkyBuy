const search_bar = document.getElementById("search-bar");
const search_bar2 = document.getElementById("search-bar2");
const categories_wrapper = document.getElementById("categories-wrapper");
const categories = document.getElementById("categories");
const filters = document.getElementById("filters");
const logo_wrapper_wrapper = document.getElementById(
  "filters-logo-wrapper-wrapper"
);
const filters_inside = document.getElementById("filters-inside");

let rect = categories.getBoundingClientRect();
categories.style.height = `calc(100vh - ${rect.top + window.scrollY}px - 1rem)`;
rect = filters.getBoundingClientRect();
filters.style.height = `calc(100vh - ${rect.top + window.scrollY}px - 1rem)`;

if (screen.width > 1100) {
  let marginTop;

  if (scrollY >= convertRemToPixels((12 + 4) / 2)) {
    marginTop = scrollY - convertRemToPixels((12 + 4) / 2);

    search_bar.style.display = "none";
    filters_inside.style.display = "none";

    search_bar2.classList.remove("hidden");
    logo_wrapper_wrapper.classList.remove("hidden");
  } else {
    marginTop = convertRemToPixels(1);

    search_bar.style.display = "flex";
    filters_inside.style.display = "flex";

    search_bar2.classList.add("hidden");
    logo_wrapper_wrapper.classList.add("hidden");
  }

  categories_wrapper.style.marginTop = `${marginTop}px`;
  filters.style.marginTop = `${marginTop <= convertRemToPixels(1)
      ? marginTop
      : marginTop + convertRemToPixels(4.5)
    }px`;
}

window.addEventListener("scroll", () => {
  if (screen.width > 1100) {
    let marginTop;

    if (scrollY >= convertRemToPixels((12 + 4) / 2)) {
      marginTop = scrollY - convertRemToPixels((12 + 4) / 2);

      search_bar.style.display = "none";
      filters_inside.style.display = "none";

      search_bar2.classList.remove("hidden");
      logo_wrapper_wrapper.classList.remove("hidden");
    } else {
      marginTop = convertRemToPixels(1);

      search_bar.style.display = "flex";
      filters_inside.style.display = "flex";

      search_bar2.classList.add("hidden");
      logo_wrapper_wrapper.classList.add("hidden");
    }

    categories_wrapper.style.marginTop = `${marginTop}px`;
    filters.style.marginTop = `${marginTop <= convertRemToPixels(1)
        ? marginTop
        : marginTop + convertRemToPixels(4.5)
      }px`;
  }
});

function convertRemToPixels(rem) {
  return rem * parseFloat(getComputedStyle(document.documentElement).fontSize);
}
