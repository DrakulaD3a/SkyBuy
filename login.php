<?php
session_start();

if (!empty($_SESSION["username"])) {
  header("Location: index.php");
}

if (!empty($_COOKIE["username"])) {
  $_SESSION["username"] = $_COOKIE["username"];
}

require_once "config.php";
require_once "validation.php";

$db = new PDO(
  "mysql:host=" . DB_HOST . ";dbname=" . DB_USERNAME,
  DB_USERNAME,
  DB_PASSWORD
);

?>

<!DOCTYPE html>
<html lang="cs">

<head>
  <meta charset="UTF-8" />
  <title>Sky Buy - přihlášení</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Online bazar pro každého">
  <link rel="stylesheet" type="text/css" href="stylesheet.css" />
  <link rel="stylesheet" type="text/css" href="stylesheet-forms.css" />
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <script src="js/snackbar.js"></script>
</head>

<body class="form-body">

  <div class="snackbar">Placeholder</div>

  <?php
  if (isset($_POST)) {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
      $username = strtolower($_POST["username"]);
      $password = $_POST["password"];

      if (login($username, $password, $db)) {
        $_SESSION["username"] = $username;
        if (isset($_POST["stay-signed-in"])) {
          setcookie("username", $username, time() + 60 * 60 * 24 * 365, '/');
        }
        header("Location: index.php");
      } else { ?>
        <script>
          showSnackbar('Wrong username or password');
        </script>
  <?php
      }
    }
  }
  ?>
  <form method="post">

    <label for="username">Uživatelské jméno</label>
    <input name="username" id="username" required />

    <label for="password">Heslo</label>
    <input type="password" name="password" id="password" required />

    <label for="stay-signed-in">Zůstat přihlášen</label>
    <input type="checkbox" name="stay-signed-in" id="stay-signed-in" />


    <button type="submit" id="submit" class="margin-top">Přihlásit se</button>
    <p>Ještě nemáte účet? <a href="register.php">Vytvořte si ho</a></p>

  </form>

</body>

</html>
