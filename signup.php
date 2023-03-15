<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("config.php");

session_start();

$db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_USERNAME, DB_USERNAME, DB_PASSWORD);

function login(string $username, string $password, $db): bool {
	$query = $db->query("SELECT * FROM users");
	$users = $query->fetchAll();

	for ($i = 0; $i < count($users); $i++) {
		if ($username == $users[$i]['username'] && md5($password) == $users[$i]['password']) {
			return true;
		}
	}
	return false;
}

if (isset($_POST['username']) && isset($_POST['password'])) {
	$user = $_POST['username'];
	$password = $_POST['password'];

	if (login($user, $password, $db)) {
		$_SESSION['user'] = $user;
		header('Location: index.php');
	} else {
		die();
		header('Location: login.php');
	}
}
