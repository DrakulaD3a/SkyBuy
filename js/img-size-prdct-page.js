console.log(document.getElementById("img-container"));

let maxWidth = document.getElementById("img-container").clientWidth;
let maxHeight = document.getElementById("img-container").clientHeight;
console.log(maxWidth);
console.log(maxHeight);

let img = document.getElementById("img");
if (img.naturalHeight < maxHeight && img.naturalWidth < maxWidth) {
  if (img.naturalHeight > img.naturalWidth) {
    img.height = maxHeight;
  } else {
    img.width = maxWidth;
  }
}
if (img.naturalHeight > maxHeight && img.naturalWidth > maxWidth) {
  let propors = img.naturalWidth / img.naturalHeight;
  if (img.naturalHeight > img.naturalWidth) {
    img.height = maxHeight;
    img.width = img.height * propors;
  } else {
    img.width = maxWidth;
    console.log(img.naturalWidth);
    img.height = img.width / propors;
  }
} else if (img.naturalWidth > maxWidth) {
  img.width = maxWidth;
} else if (img.naturalHeight > maxHeight) {
  let propors = img.naturalWidth / img.naturalHeight;
  img.height = maxHeight;
  img.width = img.height * propors;
}

window.addEventListener("resize", () => {
  maxWidth = document.getElementById("img-container").clientWidth;
  maxHeight = document.getElementById("img-container").clientHeight;

  if (img.naturalHeight < maxHeight && img.naturalWidth < maxWidth) {
    if (img.naturalHeight > img.naturalWidth) {
      img.height = maxHeight;
    } else {
      img.width = maxWidth;
    }
  }
  if (img.naturalHeight > maxHeight && img.naturalWidth > maxWidth) {
    let propors = img.naturalWidth / img.naturalHeight;
    if (img.naturalHeight > img.naturalWidth) {
      img.height = maxHeight;
      img.width = img.height * propors;
    } else {
      img.width = maxWidth;
      console.log(img.naturalWidth);
      img.height = img.width / propors;
    }
  } else if (img.naturalWidth > maxWidth) {
    img.width = maxWidth;
  } else if (img.naturalHeight > maxHeight) {
    //let propors = img.naturalWidth / img.naturalHeight;
    img.height = maxHeight;
    //img.width = img.height * propors;
  }
});

function convertRemToPixels(rem) {
  return rem * parseFloat(getComputedStyle(document.documentElement).fontSize);
}
