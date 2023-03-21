<?php

if (!isset($_POST)) {
    header("Location: add.php");
}

[
    "title" => $title,
    "description" => $description,
    "category" => $category,
    "price" => $price,
] = $_POST;

// Image isn't required so check if exists
if (isset($_POST["image"])) {
    $image = $_POST["image"];
}

// TODO: Send to db
