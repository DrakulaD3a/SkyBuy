<?php
session_start();

if(empty($_SESSION['user'])){
	header('Location: login.php');
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

			<form method="post" action="filter.php" class="search-bar space-between" >
				<label for="search">Vyhledat:</label>
				<input type="text" name="search" class="search" />
				<label for="min">Cena od:</label>
				<input type="number" name="min" id="min" />
				<label for="max">do:</label>
				<input type="number" name="max" id="max" />
				<button type="submit">Vyhledat</button>
			</form>

			<a href="add.php" id="add-poster" class="center" >Přidat Inzerát</a>
		</div>

		<main id="main">
			main
		</main>

		<div id="side-bar" >
			<h3>Kategorie:</h3>
			<a>1</a>
			<a>1</a>
			<a>1</a>
			<a>1</a>
			<a>1</a>
			<a>1</a>
			<a>1</a>
			<a>1</a>
			<a>1</a>
			<a>1</a>
			<a>1</a>
		</div>

		<div id="footer" >
			footer
		</div>

	</body>
</html>
