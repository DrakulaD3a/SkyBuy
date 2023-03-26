<?php
// TODO: Stay signed in
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
    <meta charset="UTF-8"/>
    <title>Bazoš - přihlášení</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css" />
    <script src="js/snackbar.js"></script>
  </head>
  <body class="form-body" >

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
        } else {?>
            <script>showSnackbar('Wrong username or password');</script>
          <?php
        }
    }
}
?>
    <form method="post" class="main-form flex flex-column align-items justify-content gap-half bg-light-blue" >

      <label for="username" >Uživatelské jméno</label>
      <input name="username" id="username" required />

      <label for="password" >Heslo</label>
      <input type="password" name="password" id="password" required />

      <input type="checkbox" name="stay-signed-in" id="stay-signed-in" />
      <label for="stay-signed-in" >Zůstat přihlášen</label>

      <button type="submit" id="submit" >Přihlásit se</button>
      <p>Ještě nemáte účet? <a href="register.php" >Vytvořte si ho</a></p>

    </form>

  </body>
</html>
