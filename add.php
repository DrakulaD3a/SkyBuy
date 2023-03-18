<!-- TODO: Css -->

<!DOCTYPE html>
<html lang="cs">
	<head>
		<meta charset="UTF-8">
		<title>Poster</title>
		<link rel="stylesheet" type="text/css" href="stylesheet.css">
	</head>
	<body>
		<form method="post" action="add-poster.php">
			<label for="title">Nadpis:</label>
			<input type="text" name="title" id="title">

			<label for="description">Popis:</label>
			<textarea name="description" id="description" maxlength="3000"></textarea>

			<label for="category">Kategorie:</label>
			<select name="category" id="category">
				<option value="1">Kategorie 1</option>
			</select>

			<label for="price">Cena:</label>
			<input type="text" name="price" id="price">

			<label for="image">Obrázek:</label>
			<input type="file" name="image" id="image" accept=".png,.jpg,.jpeg">

			<button type="submit">Přidat</button>
		</form>
	</body>
</html>
