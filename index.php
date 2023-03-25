<?php
session_start();

require_once "config.php";

if (empty($_SESSION["username"])) {
    header("Location: login.php");
}

$db = new PDO(
    "mysql:host=" . DB_HOST . ";dbname=" . DB_USERNAME,
    DB_USERNAME,
    DB_PASSWORD
);

//SELECT * FROM posts INNER JOIN categories ON posts.category_id=categories.id WHERE categories.name = "" ORDER BY price;

$objects = $db->query("SELECT * FROM posts")->fetchAll();

if (isset($_POST["search"])) {
    if (isset($_POST["min"]) && isset($_POST["max"])) {
        if (isset($_GET["category"])) {
            // Query for a specific category
            // FIXME: Check if category exists
        }
    }
}
?>

<!DOCTYPE html>
<!-- TODO: CSS, a lot -->
<html lang="cs">
  <head>
    <meta charset="UTF-8"/>
    <title>Bazoš</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css" />
  </head>
  <body id="main-body">

    <div id="header" class="flex space-between align-items-start padding-0-2" >
      <p>Logo</p>

      <div id="filter" class="flex align-items space-between bg-dark-blue gap-half" >
        <form method="post">
          <label for="search">Vyhledat:</label>
          <input type="text" name="search" class="search" />
          <label for="min">Cena od:</label>
          <input type="number" name="min" class="width-2" />
          <label for="max">do:</label>
          <input type="number" name="max" class="width-2" />
          <button type="submit">Vyhledat</button>
        </form>
      </div>

      <div id="profile" class="bg-dark-blue">
        <span class="flex justify-content align-items padding-0-2 height-full" >
          Profil
        </span>
        <div id="profile-content" >
          <a href="logout.php">Odhlásit</a>
          <a href="add.php">Přidat Inzerát</a>
        </div>
      </div>
    </div>

    <main id="main" >
<?php
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
    <img src="data:image/png;base64,<?= $object["pic"] ?>" width="100%" />
    <h3><?= $object["title"] ?></h3>
    <p><?= $object["description"] ?></p>
  </a>
  <?php
}
?>
    </main>

        <div id="side-bar" class="flex align-items bg-dark-blue flex-column padding-1" >
          <h3>Kategorie:</h3>
<?php
$categories = $db->query("SELECT * FROM categories ORDER BY id")->fetchAll();

$categories = $db->query("SELECT * FROM categories")->fetchAll();
foreach ($categories as $category) {
  echo "<a href='index.php?category=" . $category["id"] ."' class='no-text-decoration category' >" . $category["name"] . "</a>";
}
?>
    </div>

    <footer id="footer" class="flex align-items space-between bg-light-blue padding-1" >
      <!-- TODO: footer -->
      <p>footer</p>
      <p>footer</p>
    </footer>

  </body>
</html>
