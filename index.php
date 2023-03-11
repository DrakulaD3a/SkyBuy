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
	<body>

		<div id="header" >
			<p>Logo</p>

			<form method="post" action="filter.php">
				<input type="text" name="search" placeholder="Vyhledat..."/>
				<label for="min">Min</label>
				<input type="number" name="min" placeholder="Min"/>
				<label for="max">Max</label>
				<input type="number" name="max" placeholder="Max"/>
				<button type="submit">Vyhledat</button>
			</form>

			<button>Přidat Inzerát</button>
		</div>

		<main>
			main
		</main>

		<div id="side-bar" >
			side-bar
		</div>

		<div id="footer" >
			footer
		</div>

	</body>
</html>
