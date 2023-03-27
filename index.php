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

?>

<!DOCTYPE html>
<!-- TODO: CSS, a lot -->
<html lang="cs">
  <head>
    <meta charset="UTF-8"/>
    <title>Bazoš</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Online bazar pro každého">
  </head>
  <body id="main-body">

    <div id="header" class="flex space-between align-items-start padding-0-2" >
      <p>Logo</p>

      <div id="filter" class="flex space-between align-items bg-dark-blue gap-half visible" >
        <form method="post" class="white">
          <label for="search">Vyhledat:</label>
          <input type="text" name="search" class="search" />
          <label for="min">Cena od:</label>
          <input type="number" name="min" id="min" />
          <label for="max">do:</label>
          <input type="number" name="max" id="max" />
          <button type="submit">Vyhledat</button>
        </form>
      </div>

      <div id="profile" class="bg-dark-blue visible">
        <span class="flex justify-content align-items padding-0-2 height-full" >
          Profil
        </span>
        <div id="profile-content" >
          <a href="logout.php">Odhlásit</a>
          <a href="add.php">Přidat inzerát</a>
          <a href="products.php">Vaše inzeráty</a>
          <a href="index.php">Všechny inzeráty</a>
        </div>
      </div>
    </div>

    <div id="side-bar" class="visible flex align-items bg-dark-blue flex-column padding-1" >
      <h3>Kategorie:</h3>
      <a href='index.php' class='no-text-decoration category' >vše</a>
<?php
$query = $db->query('SELECT * FROM categories;');
$categories = $query->fetchAll();

foreach ($categories as $category) {
  echo "<a href='index.php?category=" . $category["id"] ."' class='no-text-decoration category' >" . $category["name"] . "</a>";
}
?>
    </div>

    <main id="main" >
<?php
$qry = "SELECT * FROM posts ";
$done = false;
$arr = [];

if (!empty($_POST["search"])){
  $qry .= "WHERE title LIKE \"%" . $_POST["search"] . "%\" ";
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
if(!empty($_POST["max"])){
  $qry .= ($done ? "AND " : "WHERE ") . "price < " . $_POST["max"] . " ";
}

$qry .= "ORDER BY date desc";

$query = $db->prepare($qry);

if(!empty($arr)){
  $query->execute($arr);
}else{
  $query->execute();
}

$objects = $query->fetchAll();


$index = 0;

foreach ($objects as $object) {
  $class = "";
  if ($index >= 3) {
    $class = "border-top ";
  }
  if ($index % 3 != 2) {
        $class = $class . "border-right";
  }
  $index++;

  ?>
  <a href="product.php?id=<?= $object["id"] ?>" class="flex align-items-start flex-column no-text-decoration padding-1 gap-half height-full <?= $class ?>">
    <img src="data:image/png;base64,<?= $object["pic"] ?>" width="100%" class="image-post" />
    <h3><?= $object["title"] ?></h3>
    <br>
    <h4><?= $object["price"]?> Kč</h4>
    <p><?= strlen($object["description"]) > 500 ? substr($object["description"], 0, 500) . "..." : $object["description"]?></p>
  </a>
  <?php
}
?>
    </main>

    <footer id="footer" class="flex align-items space-between bg-light-blue padding-1" >
      <!-- TODO: footer -->
      <p>footer</p>
      <p>footer</p>
    </footer>

  </body>
</html>
