<?php

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
  if (empty($_FILES["image"]["error"])) {
    [
      "title" => $title,
      "contact" => $contact,
      "description" => $description,
      "category" => $category_id,
      "price" => $price,
    ] = $_POST;

    $user_id = $db->query("SELECT id FROM users WHERE username = '" . $_SESSION["username"] . "'")->fetch()["id"];

    $image_raw = file_get_contents($_FILES["image"]["tmp_name"]);

    $stmt = $db->prepare(
      "INSERT INTO `posts` (user_id, category_id, contact, pic, title, description, price, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?);"
    );
    $stmt->execute([$user_id, $category_id, $contact, base64_encode($image_raw), $title, $description, $price, date("Y-m-d H:i:s")]);

    header("Location: index.php");
  }
}
?>

<!DOCTYPE html>
<html lang="cs">

<head>
  <meta charset="UTF-8">
  <title>Bazoš - nový inzerát</title>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <script src="js/snackbar.js"></script>
</head>

<body class="form-body">

  <div class="snackbar"></div>

  <?php
  if (!empty($_FILES["image"]["error"])) { ?>
    <script>
      showSnackbar('Image too big');
    </script>
  <?php
  }
  ?>

  <form method="post" enctype="multipart/form-data" class="main-form flex flex-column align-items justify-content gap-half bg-light-blue">
    <label for="title">Nadpis:</label>
    <input type="text" name="title" id="title" maxlength="50" required>

    <label for="contact">Kontakt:</label>
    <input type="text" name="contact" id="contact" maxlength="50" required>

    <label for="description">Popis:</label>
    <textarea name="description" id="description" maxlength="3000" required></textarea>

    <label for="category">Kategorie:</label>
    <select name="category" id="category" required>
      <?php
      $categories = $db->query("SELECT * FROM categories")->fetchAll();
      foreach ($categories as $category) {
        echo "<option value='" . $category["id"] . "'>" . $category["name"] . "</option>";
      }
      ?>
    </select>

    <label for="price">Cena:</label>
    <input type="number" name="price" id="price" max="10000000" required>

    <label for="image">Obrázek:</label>
    <input type="file" name="image" id="image" accept="image/*" required>

    <button class="margin-top" type="submit">Přidat</button>

    <a href="index.php">zpět</a>
  </form>

</body>

</html>
