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
    <title>Sky-buy</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="stylesheet.css" />
    <link rel="stylesheet" type="text/css" href="stylesheet-product.css" />
    <script src="https://kit.fontawesome.com/d9f7f676cb.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <form id="search-bar" action="index.php">
      <input type="text" name="search" maxlength="50" placeholder="<?=trim($post["title"])?>" value="<?=$_GET["search"]?>"/>
      <button type="submit"><i class="fa-solid fa-magnifying-glass fa-2xl"></i></button>
    </form>
    <div id="product-description">
    <div id="product-title">
      <div id="product-title-text"><?= $post['title'] ?></div>
    </div>
    <ul>
      <li><strong>přidáno:</strong>  <?= date("d.m.Y", strtotime($post['date'])) ?> <strong>uživatelem</strong> <?= $user["username"]?></li>
      <li><strong>kontakt:</strong>  <?= $post['contact']?></li>
      <li><strong>popis:</strong></li>
      <div id="product-description-content"><?=$post['description']?></div>
    </ul>
    <div id="back-div">
      <a id="back-a" href="index.php">zpět</a>
    </div>
    </div>
    <div id="price">
      <?= $post['price']?> Kč
    </div>
    <div id="img-container">
      <img id="img" src="data:image/png;base64,<?= $post['pic'] ?>"/>
    </div>
  </div>
</body>

</html>
