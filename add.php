<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

if (empty($_SESSION["username"])) {
    header("Location: login.php");
}

require_once "config.php";

$db = new PDO(
    "mysql:host=" . DB_HOST . ";dbname=" . DB_USERNAME,
    DB_USERNAME,
    DB_PASSWORD
);

if (isset($_POST["title"])) {
    [
        "title" => $title,
        "description" => $description,
        "category" => $category_id,
        "price" => $price,
        "image" => $image,
    ] = $_POST;

    $user_id = $db->query("SELECT id FROM users WHERE username = '" . $_SESSION["username"] . "'")->fetch()["id"];
    echo $user_id;

    $stmt = $db->prepare(
        "INSERT INTO `posts` (user_id, category_id, pic, title, description, price, date) VALUES (?, ?, ?, ?, ?, ?, ?);"
    );
    $stmt->execute([$user_id, $category_id, base64_encode($image), $title, $description, $price, date("Y-m-d H:i:s")]);
}

?>

<!DOCTYPE html>
<html lang="cs">
  <head>
    <meta charset="UTF-8">
    <title>Bazoš - nový inzerát</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
  <body class="form-body" >

    <form method="post" class="main-form flex direction-column align-items justify-content gap-half bg-light-blue" >
      <label for="title" class="padding-top-5">Nadpis:</label>
      <input type="text" name="title" id="title" required>

      <label for="description">Popis:</label>
      <textarea name="description" id="description" maxlength="3000" required></textarea>

      <label for="category">Kategorie:</label>
      <select name="category" id="category" required>
        <!-- TODO: Get categories from db -->
        <option value="1">Kategorie 1</option>
      </select>

      <label for="price">Cena:</label>
      <input type="number" name="price" id="price" required>

      <label for="image">Obrázek:</label>
      <input type="file" name="image" id="image" accept=".png" required>

      <button type="submit">Přidat</button>
    </form>

  </body>
</html>
