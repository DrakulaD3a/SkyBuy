<?php

require_once "config.php";

if (!isset($_GET['id'])) {
    // TODO: redirect to 404 page
    echo "Post not found";
    exit;
}
$id = $_GET['id'];

$db = new PDO(
    "mysql:host=" . DB_HOST . ";dbname=" . DB_USERNAME,
    DB_USERNAME,
    DB_PASSWORD
);

$query = $db->prepare("SELECT * FROM `posts` WHERE `id` = ?");
$query->execute([$id]);

if ($query->rowCount() == 0) {
    // TODO: redirect to 404 page
    echo "Post not found";
    exit;
}

$post = $query->fetch();

?>

<!DOCTYPE html>
<html lang="cz">
  <head>
    <meta charset="UTF-8">
    <title>Bazoš</title>
  </head>
  <body>
    <h1><?= $post['title'] ?></h1>
    <p><?= $post['description'] ?></p>
    <!-- I have an image encoded in base64 in $post['pic'], show it -->
    <img src="data:image/png;base64,<?= $post['pic'] ?>" />
  </body>
</html>
