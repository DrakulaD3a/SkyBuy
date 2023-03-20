<?php

if (empty($_POST)) {
	header("Location: add.php");
}

// TODO: Prepare the data and send it to db

[
	"title" => $title,
	"description" => $description,
	"category" => $category,
	"price" => $price,
] = $_POST;

if(!empty($_POST["image"])) {
	$image = $_POST["image"];
}
