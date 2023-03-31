let maxWidth =
  document.getElementsByClassName("post")[0].clientWidth / 2 -
  convertRemToPixels(5.5);
let maxHeight =
  document.getElementsByClassName("post")[0].clientHeight -
  convertRemToPixels(4);

let imgs = document.getElementsByClassName("product-img");
for (let element of imgs) {
  if (element.naturalHeight < maxHeight && element.naturalWidth < maxWidth) {
    if (element.naturalHeight > element.naturalWidth) {
      element.height = maxHeight;
    } else {
      element.width = maxWidth;
    }
  }
  if (element.naturalHeight > maxHeight && element.naturalWidth > maxWidth) {
    let propors = element.naturalWidth / element.naturalHeight;
    if (element.naturalHeight > element.naturalWidth) {
      element.height = maxHeight;
      element.width = element.height * propors;
    } else {
      element.width = maxWidth;
      element.height = element.width / propors;
    }
  } else if (element.naturalWidth > maxWidth) {
    element.width = maxWidth;
  } else if (element.naturalHeight > maxHeight) {
    let propors = element.naturalWidth / element.naturalHeight;
    element.height = maxHeight;
    element.width = element.height * propors;
  }
}

window.addEventListener("resize", () => {
  maxWidth =
    document.getElementsByClassName("post")[0].clientWidth / 2 -
    convertRemToPixels(3.5);
  maxHeight =
    document.getElementsByClassName("post")[0].clientHeight -
    convertRemToPixels(4);
  for (let element of imgs) {
    if (element.naturalHeight < maxHeight && element.naturalWidth < maxWidth) {
      if (element.naturalHeight > element.naturalWidth) {
        element.height = maxHeight;
      } else {
        element.width = maxWidth;
      }
    }
    if (element.naturalHeight > maxHeight && element.naturalWidth > maxWidth) {
      let propors = element.naturalWidth / element.naturalHeight;
      if (element.naturalHeight > element.naturalWidth) {
        element.height = maxHeight;
        element.width = element.height * propors;
      } else {
        element.width = maxWidth;
        console.log(element.naturalWidth);
        element.height = element.width / propors;
      }
    } else if (element.naturalWidth > maxWidth) {
      element.width = maxWidth;
    } else if (element.naturalHeight > maxHeight) {
      element.height = maxHeight;
    }
  }
});

function convertRemToPixels(rem) {
  return rem * parseFloat(getComputedStyle(document.documentElement).fontSize);
}
