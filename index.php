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


$qry = "SELECT * FROM posts ";
$done = false;
$arr = [];

if (!empty($_GET["search"])) {
  $qry .= "WHERE title LIKE \"%" . $_GET["search"] . "%\" ";
  $done = true;
}
if (!empty($_GET["category"])) {
  $qry .= ($done ? "AND " : "WHERE ") . "category_id = ? ";
  $done = true;
  array_push($arr, $_GET["category"]);
}
if (!empty($_POST["min"])) {
  $qry .= ($done ? "AND " : "WHERE ") . "price > " . $_POST["min"] . " ";
  $done = true;
}
if (!empty($_POST["max"])) {
  $qry .= ($done ? "AND " : "WHERE ") . "price < " . $_POST["max"] . " ";
}

$qry .= "ORDER BY ";
$qry .= $_GET["sort"] == "price" ? "price ASC" : "date DESC";

$query = $db->prepare($qry);

if (!empty($arr)) {
  $query->execute($arr);
} else {
  $query->execute();
}

?>

<!DOCTYPE html>
<html lang="cs">

<head>
  <meta charset="UTF-8" />
  <title>Sky-Buy</title>
  <link rel="stylesheet" type="text/css" href="stylesheet.css" />
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Online bazar pro každého">
  <script src="https://kit.fontawesome.com/d9f7f676cb.js" crossorigin="anonymous"></script>
  <script defer src="js/scroll.js"></script>
</head>

<body>

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
      <h3>Další filtry</h3>
    </div>

    <div id="products">
      <?php
      $objects = $query->fetchAll();

      foreach ($objects as $object) { ?>
        <a href="product.php?id=<?= $object["id"] ?>&search=<?= $_GET["search"] ?>" class="post">
          <img src="data:image/png;base64,<?= $object["pic"] ?>" />
          <h3><?= $object["title"] ?></h3>
          <h4><?= $object["price"] ?> Kč</h4>
          <p><?= strlen($object["description"]) > 500 ? substr($object["description"], 0, 500) . "..." : $object["description"] ?></p>
        </a>
      <?php
      } ?>

    </div>

  </main>

</body>

</html>
