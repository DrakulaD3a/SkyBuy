<?php
session_start();

if (empty($_SESSION["username"])) {
    header("Location: login.php");
}

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

      <!-- FIXME: Remove this part, just for testing -->
      <a href="product.php" class="flex align-items-start direction-column no-text-decoration height-min-content padding-1 color-inherit border-right gap-half">
        <img src="https://www.bhphotovideo.com/images/images2500x2500/asus_x55a_ds91_15_6_notebook_computer_924693.jpg" alt="poster" width="100%" />
        <h3>Inzeráty</h3>
        <p>
          Lorem ipsum dolor sit amet, officia excepteur ex fugiat reprehenderit enim labore culpa sint ad nisi Lorem pariatur mollit ex esse exercitation amet. Nisi anim cupclassatat excepteur officia. Reprehenderit nostrud nostrud ipsum Lorem est aliquip amet voluptate voluptate dolor minim nulla est proident. Nostrud officia pariatur ut officia. Sit irure elit esse ea nulla sunt ex occaecat reprehenderit commodo officia dolor Lorem duis laboris cupidatat officia voluptate. Culpa proident adipisicing id nulla nisi laboris ex in Lorem sunt duis officia eiusmod. Aliqua reprehenderit commodo ex non excepteur duis sunt velit enim. Voluptate laboris sint cupidatat ullamco ut ea consectetur et est culpa et culpa duis.
        </p>
      </a>

<?php
/* $index = 0;
foreach ($objects as $object) {
  $class = '';
  if ($index >= 3) {
    $class = 'border-top ';
  }
  if ($index % 3 != 2) {
        $class = $class . 'border-right';
  }

  // Hopefully this works
  // TODO: Create the product page

  echo "<a href='product.php?id={$object['id']}' class='flex align-items-start direction-column no-text-decoration height-min-content padding-1 color-inherit gap-half {$class}'>";
  echo "<img src='data:image/png;base64,$object['image']' alt='poster' width="100%" />";
  echo '<h3>Inzeráty</h3>';
  echo '<p>Lorem ipsum dolor sit amet, officia excepteur ex fugiat reprehenderit enim labore culpa sint ad nisi Lorem pariatur mollit ex esse exercitation amet. Nisi anim cupclassatat excepteur officia. Reprehenderit nostrud nostrud ipsum Lorem est aliquip amet voluptate voluptate dolor minim nulla est proident. Nostrud officia pariatur ut officia. Sit irure elit esse ea nulla sunt ex occaecat reprehenderit commodo officia dolor Lorem duis laboris cupidatat officia voluptate. Culpa proident adipisicing id nulla nisi laboris ex in Lorem sunt duis officia eiusmod. Aliqua reprehenderit commodo ex non excepteur duis sunt velit enim. Voluptate laboris sint cupidatat ullamco ut ea consectetur et est culpa et culpa duis.</p>';
  echo '</a>';
} */
?>
    </main>

        <div id="side-bar" class="flex align-items bg-dark-blue round-border direction-column height-min-content margin-2 padding-1" >
        <h3>Kategorie:</h3>
<?php
// TODO: Get from db

/* $categories = $db->query("SELECT * FROM categories")->fetchAll();
foreach ($categories as $category) {
  // HACK: I can't think of any other way to do this

  echo "<a href='index.php?category=$category' >$category</a>";
} */
?>
    </div>

    <footer id="footer" class="flex align-items space-between bg-light-blue padding-1" >
      <!-- TODO -->
      <p>footer</p>
      <p>footer</p>
    </footer>

  </body>
</html>
