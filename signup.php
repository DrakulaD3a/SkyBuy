<?php

['username' => $username, 'password' => $password] = $_POST;

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

if (isset($_POST['user']) && isset($_POST['password'])) {
	$user = $_POST['user'];
	$password = $_POST['password'];

	if (login($user, $password, $db)) {
		$_SESSION['username'] = $user;
		header('Location: login.php');
	} else {
		header('Location: login.php');
		die();
	}
}
