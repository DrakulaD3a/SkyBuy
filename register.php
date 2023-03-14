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
		
		<form method="post" action="create_user.php" >

			<label for="username" >Username</label>
			<input name="username" id="username" required />

			<label for="password" >Heslo</label>
			<input type="password" name="password" id="password" required />

			<label for="password" >Heslo znovu</label>
			<input type="password" name="password-repeat" id="password-repeat" required />

			<button type="submit" id="submit" >Zaregistrovat se</button>

		</form>

	</body>
</html>
