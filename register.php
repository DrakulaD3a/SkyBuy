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
  <title>Bazoš - registrace</title>
  <link rel="stylesheet" type="text/css" href="stylesheet.css" />
  <link rel="stylesheet" type="text/css" href="stylesheet-login.css" />
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <script src="js/snackbar.js"></script>
</head>

<body class="form-body">

  <div class="snackbar"></div>

  <?php
  if (!empty($_POST)) {
    [
      "username" => $username,
      "password" => $password,
      "password-repeat" => $password_repeat,
    ] = $_POST;
    $username = strtolower($username);

    if (!empty($username) && !empty($password)) {
      if ($password == $password_repeat) {
        if (is_password_valid($password)) {
          if (is_username_available($username, $db)) {
            $stmt = $db->prepare(
              "INSERT INTO users (username, password) VALUES (?, ?);"
            );
            $stmt->execute([$username, md5($password)]);

            $_SESSION["username"] = $username;
            if (isset($_POST['stay-signed-in'])) {
              setcookie("username", $username, time() + 60 * 60 * 24 * 365, '/');
            }
            header("Location: index.php");
          } else { ?>
            <script>
              showSnackbar('Username already exists');
            </script>
          <?php
          }
        } else { ?>
          <script>
            showSnackbar('Password is not valid');
          </script>
        <?php
        }
      } else { ?>
        <script>
          showSnackbar('Passwords do not match');
        </script>
      <?php
      }
    } else { ?>
      <script>
        showSnackbar('Username and password are required');
      </script>
  <?php
    }
  }
  ?>
  <form method="post" class="main-form flex flex-column align-items justify-content gap-half bg-light-blue">

    <label for="username">Uživatelské jméno</label>
    <input name="username" id="username" required />

    <label for="password">Heslo</label>
    <input type="password" name="password" id="password" required />

    <label for="password">Heslo znovu</label>
    <input type="password" name="password-repeat" id="password-repeat" required />

    <label for="stay-signed-in">Zůstat přihlášen</label>
    <input type="checkbox" name="stay-signed-in" id="stay-signed-in" />


    <button type="submit" id="submit" class="margin-top">Zaregistrovat se</button>
    <p>Již máte účet? <a href="login.php">Přihlašte se</a></p>

  </form>

</body>

</html>
