<?php

require_once "config.php";

if (!isset($_GET['id'])) {
  // TODO: redirect to 404 page
  echo "Post not found";
  exit;
}
$id = $_GET['id'];

$db = new PDO(
  "mysql:host=" . DB_HOST . ";dbname=" . DB_USERNAME,
  DB_USERNAME,
  DB_PASSWORD
);

$query = $db->prepare("SELECT * FROM `posts` WHERE `id` = ?");
$query->execute([$id]);

if ($query->rowCount() == 0) {
  // TODO: redirect to 404 page
  echo "Post not found";
  exit;
}

$post = $query->fetch();

$query = $db->prepare("SELECT username FROM `users` WHERE `id` = ?");
$query->execute([$post["user_id"]]);

$user = $query->fetch();


?>

<!-- TODO: Create this page -->
<!DOCTYPE html>
<html lang="cz">

<head>
  <meta charset="UTF-8">
  <title>Bazoš</title>
  <link rel="stylesheet" type="text/css" href="stylesheet.css" />
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
</head>

<body>
  <div id="container">
    <div id="product-title">
      <h1 id="product-title-text"><?= $post['title'] ?></h1>
    </div>
    <div id="product-description">
      <ul>
        <li><strong>přidáno:</strong> <?= date("d.m.Y", strtotime($post['date'])) ?> <strong>uživatelem</strong> <?= $user["username"] ?></li>
        <br>
        <li><strong>cena:</strong> <?= $post['price'] ?> Kč</li>
        <br>
        <li><strong>kontakt:</strong> <?= $post['contact'] ?></li>
        <br>
        <li><strong>popis:</strong></li>
        <div id="product-description-content"><?= $post['description'] ?></div>
      </ul>
      <a id="back-a" href="index.php">zpět</a>
    </div>
    <div id="img-container">
      <img id="img" src="data:image/png;base64,<?= $post['pic'] ?>" />
    </div>
  </div>
</body>

</html>
