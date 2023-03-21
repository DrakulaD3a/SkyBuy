<?php

// FIXME: Check if id is valid
$id = $_GET['id'];

$db = new PDO(
    "mysql:host=" . DB_HOST . ";dbname=" . DB_USERNAME,
    DB_USERNAME,
    DB_PASSWORD
);

$query = $db->prepare("SELECT * FROM `posts` WHERE `id` = ?");
$query->execute([$id]);

if (empty($query)) {
    echo "Post not found";
    exit;
}
