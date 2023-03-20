<?php
session_start();

if (empty($_SESSION["user"])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="cs">
  <head>
    <meta charset="UTF-8">
    <title>Poster</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
  <body>

    <main class="padding-1" >
      <form method="post" action="add-poster.php" class="flex direction-column align-items justify-content gap-half" >
        <label for="title">Nadpis:</label>
        <input type="text" name="title" id="title" required>

        <label for="description">Popis:</label>
        <textarea name="description" id="description" maxlength="3000" required></textarea>

        <label for="category">Kategorie:</label>
        <select name="category" id="category" required>
          <option value="1">Kategorie 1</option>
        </select>

        <label for="price">Cena:</label>
        <input type="number" name="price" id="price" required>

        <label for="image">Obrázek:</label>
        <input type="file" name="image" id="image" accept=".png,.jpg,.jpeg">

        <button type="submit">Přidat</button>
      </form>
    </main>

  </body>
</html>
