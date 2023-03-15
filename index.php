<?php
session_start();

if(empty($_SESSION['user'])){
	header('Location: login.php');
}

if(isset($_POST['search'])){
	if (isset($_POST['min']) && isset($_POST['max'])){
		// TODO: Get an array of all objects in the db
		// $objects
	}
}
?>

<!DOCTYPE html>
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

	<!-- TODO: Add a logout button -->

			<a href="add.php" id="add-poster" class="center" >Přidat Inzerát</a>
		</div>

		<main id="main">
<?php
/* foreach ($objects as $object) {
} */
?>
		</main>

		<div id="side-bar" >
			<h3>Kategorie:</h3>
<?php
// TODO: Get from db
/* $categories = $pdo->query("SELECT * FROM categories")->fetchAll();
for ($i = 0; $i < count($categories); $i++) {
	echo '<a></a>';
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
