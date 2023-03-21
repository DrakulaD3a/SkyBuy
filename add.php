<?php
session_start();

if (empty($_SESSION["username"])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="cs">
  <head>
    <meta charset="UTF-8">
    <title>Bazoš - nový inzerát</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
  <body class="form-body" >

    <form method="post" action="add-poster.php" class="main-form flex direction-column align-items justify-content gap-half bg-light-blue" >
      <label for="title" class="padding-top-5">Nadpis:</label>
      <input type="text" name="title" id="title" required>

      <label for="description">Popis:</label>
      <textarea name="description" id="description" maxlength="3000" required></textarea>

      <label for="category">Kategorie:</label>
      <select name="category" id="category" required>
        <!-- TODO: Get categories from db -->
        <option value="1">Kategorie 1</option>
      </select>

      <label for="price">Cena:</label>
      <input type="number" name="price" id="price" required>

      <label for="image">Obrázek:</label>
      <input type="file" name="image" id="image" accept=".png,.jpg,.jpeg">

      <button type="submit">Přidat</button>
    </form>

  </body>
</html>
