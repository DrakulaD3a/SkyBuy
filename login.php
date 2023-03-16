<?php
session_start();

if (!empty($_SESSION['user'])) {
	header('Location: index.php');
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
		
		<form method="post" action="signup.php" >

			<label for="username" >Username</label>
			<input name="username" id="username" required />

			<label for="password" >Password</label>
			<input type="password" name="password" id="password" required />

			<button type="submit" id="submit" >Přihlásit se</button>
			<p>Don't have an account yet? <a href="register.php" >Create one now</a></p>

		</form>

	</body>
</html>
