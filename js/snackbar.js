function showSnackbar(message) {
  var snackbar = document.getElementsByClassName("snackbar")[0];
  snackbar.innerHTML = message;
  snackbar.className += " show";
  setTimeout(
    () => (snackbar.className = snackbar.className.replace(" show", "")),
    3000
  );
}
