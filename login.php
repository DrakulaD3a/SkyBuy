<?php
session_start();

if (!empty($_SESSION["user"])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="cs">
	<head>
		<meta charset="UTF-8"/>
		<title>Bazoš - přihlášení</title>
		<link rel="stylesheet" type="text/css" href="stylesheet.css" />
	</head>
	<body>
		
		<main class="padding-1" >
			<form method="post" action="signup.php" class="flex direction-column align-items justify-content gap-half" >

				<label for="username" >Uživatelské jméno</label>
				<input name="username" id="username" required />

				<label for="password" >Heslo</label>
				<input type="password" name="password" id="password" required />

				<button type="submit" id="submit" >Přihlásit se</button>
				<p>Ještě nemáte účet? <a href="register.php" >Vytvořte si ho</a></p>

			</form>
		</main>

	</body>
</html>
