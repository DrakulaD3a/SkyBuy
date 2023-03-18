<?php
session_start();

if (empty($_SESSION['user'])){
	header('Location: login.php');
}

if (isset($_POST['search'])){
	if (isset($_POST['min']) && isset($_POST['max'])){
		// TODO: Get an array of all objects in the db
		// $objects
		if (isset($_GET['category'])) {
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

		<div id="header">
			<p>Logo</p>

			<form method="post" class="search-bar space-between" >
				<label for="search">Vyhledat:</label>
				<input type="text" name="search" class="search" />
				<label for="min">Cena od:</label>
				<input type="number" name="min" id="min" />
				<label for="max">do:</label>
				<input type="number" name="max" id="max" />
				<button type="submit">Vyhledat</button>
			</form>

			<a href="logout.php">Odhlásit</a>

			<a href="add.php" id="add-poster" class="center" >Přidat Inzerát</a>
		</div>

		<main id="main">
			<a href="product.php" class="poster">
				<img src="https://www.bhphotovideo.com/images/images2500x2500/asus_x55a_ds91_15_6_notebook_computer_924693.jpg" alt="poster" />
				<h3>Inzeráty</h3>
				<p>
					Lorem ipsum dolor sit amet, officia excepteur ex fugiat reprehenderit enim labore culpa sint ad nisi Lorem pariatur mollit ex esse exercitation amet. Nisi anim cupclassatat excepteur officia. Reprehenderit nostrud nostrud ipsum Lorem est aliquip amet voluptate voluptate dolor minim nulla est proident. Nostrud officia pariatur ut officia. Sit irure elit esse ea nulla sunt ex occaecat reprehenderit commodo officia dolor Lorem duis laboris cupidatat officia voluptate. Culpa proident adipisicing id nulla nisi laboris ex in Lorem sunt duis officia eiusmod. Aliqua reprehenderit commodo ex non excepteur duis sunt velit enim. Voluptate laboris sint cupidatat ullamco ut ea consectetur et est culpa et culpa duis.
				</p>
			</a>

			<a href="product.php" class="poster">
				<img src="https://www.bhphotovideo.com/images/images2500x2500/asus_x55a_ds91_15_6_notebook_computer_924693.jpg" alt="poster" />
				<h3>Inzeráty</h3>
				<p>
					Lorem ipsum dolor sit amet, officia excepteur ex fugiat reprehenderit enim labore culpa sint ad nisi Lorem pariatur mollit ex esse exercitation amet. Nisi anim cupclassatat excepteur officia. Reprehenderit nostrud nostrud ipsum Lorem est aliquip amet voluptate voluptate dolor minim nulla est proident. Nostrud officia pariatur ut officia. Sit irure elit esse ea nulla sunt ex occaecat reprehenderit commodo officia dolor Lorem duis laboris cupidatat officia voluptate. Culpa proident adipisicing id nulla nisi laboris ex in Lorem sunt duis officia eiusmod. Aliqua reprehenderit commodo ex non excepteur duis sunt velit enim. Voluptate laboris sint cupidatat ullamco ut ea consectetur et est culpa et culpa duis.
				</p>
			</a>

<?php
/* foreach ($objects as $object) {
} */
?>
		</main>

		<div id="side-bar" >
			<h3>Kategorie:</h3>
<?php
// TODO: Get from db

/* $categories = $db->query("SELECT * FROM categories")->fetchAll();
foreach ($categories as $category) {
	echo "<a href='index.php?category=$category' >$category</a>";
} */
?>
		</div>

		<footer id="footer">
			<!-- TODO -->
			<p>footer</p>
			<p>footer</p>
		</footer>

	</body>
</html>
