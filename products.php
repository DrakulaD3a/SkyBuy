<?php

session_start();

require_once "config.php";

if (empty($_SESSION["username"])) {
  if (!empty($_COOKIE["username"])) {
    $_SESSION["username"] = $_COOKIE["username"];
  } else {
    header("Location: login.php");
  }
}

$db = new PDO(
  "mysql:host=" . DB_HOST . ";dbname=" . DB_USERNAME,
  DB_USERNAME,
  DB_PASSWORD
);

$query = $db->prepare("SELECT id FROM `users` WHERE username = ?");
$query->execute([$_SESSION["username"]]);
$user = $query->fetch();

$query = $db->prepare('DELETE FROM posts WHERE id = ? and user_id = ?;');
$query->execute([$_GET["product_id"], $user["id"]]);

$qry = "SELECT * FROM posts WHERE user_id = ? ";
$done = false;
$arr = [$user["id"]];

if (!empty($_POST["search"])) {
  $qry .= "AND title LIKE \"%" . $_POST["search"] . "%\" ";
}
if (!empty($_GET["category"])) {
  $qry .= "AND category_id = ? ";
  array_push($arr, $_GET["category"]);
}
if (!empty($_POST["min"])) {
  $qry .= "AND price > " . $_POST["min"] . " ";
}
if (!empty($_POST["max"])) {
  $qry .= "AND price < " . $_POST["max"] . " ";
}

$qry .= "ORDER BY ";
$qry .= $_GET["sort"] == "price" ? "price ASC" : "date DESC";

$query = $db->prepare($qry);

$query->execute($arr);

?>

<!DOCTYPE html>
<html lang="cs">

<head>
  <meta charset="UTF-8" />
  <title>Sky Buy</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Online bazar pro každého">
  <link rel="stylesheet" type="text/css" href="stylesheet.css" />
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <script src="https://kit.fontawesome.com/d9f7f676cb.js" crossorigin="anonymous"></script>
  <script defer src="js/scroll.js"></script>
  <script defer src="js/img-size.js"></script>
</head>

<body id="index-body">

  <div id="logo">
    <img src="assets/logo.png" />
  </div>

  <div id="profile">
    <div id="logo-butt">
      <i class="fa-solid fa-user fa-2xl"></i>
      <div id="logo-hover">
        <div id="name"><?= $_SESSION["username"] ?></div>
        <a href="logout.php">Odhlásit se</a>
        <a href="add.php">Přidat inzerát</a>
      </div>
    </div>

    <div id="menu">
      <i class="fa-solid fa-ellipsis fa-2xl"></i>
      <div id="menu-hover">
        <a href="products.php">Vaše inzeráty</a>
        <a href="index.php">Všechny inzeráty</a>
      </div>
    </div>
  </div>

  <div>
    <form id="search-bar">
      <input type="text" maxlength="50" name="search" placeholder="Audi TT" value="<?= $_GET["search"] ?>" />
      <button type="submit"><i class="fa-solid fa-magnifying-glass fa-2xl"></i></button>
    </form>
  </div>

  <main id="main">

    <div id="categories-wrapper">
      <div id="search-bar2" class="hidden">
        <form>
          <button type="submit"><i class="fa-solid fa-magnifying-glass fa-xl"></i></button>
          <input type="text" maxlength="32" name="search" />
        </form>
      </div>
      <div id="categories">
        <h3>Kategorie</h3>
        <ul>
          <li><a href="index.php">vše</a></li>
          <?php
          $catQuery = $db->query('SELECT * FROM categories;');
          $categories = $catQuery->fetchAll();

          foreach ($categories as $category) { ?>
            <li><a href="index.php?category=<?= $category["id"] ?>" class=""><?= $category["name"] ?></a></li>
          <?php
          } ?>
        </ul>
      </div>
    </div>

    <div id="filters">
      <div id="filters-logo-wrapper-wrapper" class="hidden">
        <div id="filters-logo-wrapper">
          <img src="assets/logo.png" id="filters-logo" />
          <h2>Sky Buy</h2>
        </div>
      </div>
      <div id="filters-inside">
        <h3>Další filtry</h3>
        <h5>Filtrovat:</h5>
        <form method="post">
          <div>
            <label for="min">Cena od:</label>
            <input type="number" name="min" id="min" />
            <label for="max">do:</label>
            <input type="number" name="max" id="max" />
          </div>
          <button type="submit">Vyhledat</button>
        </form>
        <h5>Řadit podle:</h5>
        <ul>
          <li><a href="index.php?sort=price">Cena</a></li>
          <li><a href="index.php?sort=date">Datum</a></li>
        </ul>
      </div>
    </div>

    <div id="products">
      <?php
      $objects = $query->fetchAll();

      foreach ($objects as $object) { ?>
        <a href="product.php?id=<?= $object["id"] ?>&search=<?= $_GET["search"] ?>" class="post">
          <img class="product-img" src="data:image/png;base64,<?= $object["pic"] ?>" />
          <h3><?= $object["title"] ?></h3>
          <h4><?= $object["price"] ?> Kč</h4>
          <p><?= $object["description"] ?></p>
          <a class="delete-btn" href="products.php?product_id=<?= $object["id"] ?>">
            Smazat
          </a>
        </a>
      <?php
      } ?>

    </div>

  </main>

</body>

</html>
