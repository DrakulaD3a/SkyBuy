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
        // TODO: Get an array of all objects in the db
        // $objects
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

      <form method="post" class="flex align-items space-between round-border-bottom bg-dark-blue gap-half padding-0-1 height-3" >
        <label for="search">Vyhledat:</label>
        <input type="text" name="search" class="search" />
        <label for="min">Cena od:</label>
        <input type="number" name="min" class="width-2" />
        <label for="max">do:</label>
        <input type="number" name="max" class="width-2" />
        <button type="submit">Vyhledat</button>
      </form>

      <div id="profile">
        <span class="flex justify-content align-items bg-dark-blue round-border-bottom no-text-decoration white padding-0-2 height-3" >
          Profil
        </span>
        <div id="profile-content" >
          <a href="logout.php">Odhlásit</a>
          <a href="add.php">Přidat Inzerát</a>
        </div>
      </div>
    </div>

    <main id="main" class="bg-white black" >
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
  <a href="product.php?id=<?= $object["id"] ?>" class="flex align-items-start direction-column no-text-decoration padding-1 color-inherit gap-half height-100 <?= $class ?>">
    <img src="data:image/png;base64,<?= $object["pic"] ?>" width="100%" />
    <h3><?= $object["title"] ?></h3>
    <p><?= $object["description"] ?></p>
  </a>
  <?php
}
?>
    </main>

        <div id="side-bar" class="flex align-items bg-dark-blue round-border direction-column height-min-content margin-2 padding-1" >
        <h3>Kategorie:</h3>
<?php
$categories = $db->query("SELECT * FROM categories ORDER BY id")->fetchAll();

$categories = $db->query("SELECT * FROM categories")->fetchAll();
foreach ($categories as $category) {
  echo "<a href='index.php?category=" . $category["id"] ."' class='white no-text-decoration category' >" . $category["name"] . "</a>";
}
?>
    </div>

    <footer id="footer" class="flex align-items space-between bg-light-blue padding-1" >
      <!-- TODO -->
      <p>footer</p>
      <p>footer</p>
    </footer>

  </body>
</html>
