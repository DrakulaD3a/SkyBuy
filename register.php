<?php
session_start();

if (!empty($_SESSION["username"])) {
    header("Location: index.php");
}

require_once "config.php";
require_once "validation.php";

if (isset($_POST)) {
    [
        "username" => $username,
        "password" => $password,
        "password-repeat" => $password_repeat,
    ] = $_POST;
    $username = strtolower($username);

    $db = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_USERNAME,
        DB_USERNAME,
        DB_PASSWORD
    );

    if (!empty($username) && !empty($password)) {
        if ($password == $password_repeat) {
            if (is_password_valid($password)) {
                if (is_username_available($username, $db)) {
                    $stmt = $db->prepare(
                        "INSERT INTO users (username, password) VALUES (?, ?);"
                    );
                    $stmt->execute([$username, md5($password)]);

                    $_SESSION["username"] = $username;
                    header("Location: index.php");
                } else {
                    echo "Username already exists";
                }
            } else {
                echo "Password is not valid";
            }
        } else {
            echo "Passwords do not match";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="cs">
  <head>
    <meta charset="UTF-8"/>
    <title>Bazoš - registrace</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css" />
  </head>
  <body class="form-body" >

    <form method="post" class="main-form flex flex-column align-items justify-content gap-half bg-light-blue" >

      <label for="username" >Uživatelské jméno</label>
      <input name="username" id="username" required />

      <label for="password" >Heslo</label>
      <input type="password" name="password" id="password" required />

      <label for="password" >Heslo znovu</label>
      <input type="password" name="password-repeat" id="password-repeat" required />

      <button type="submit" id="submit" >Zaregistrovat se</button>
      <p>Již máte účet?<a href="login.php" >Přihlašte se</a></p>

    </form>

  </body>
</html>
