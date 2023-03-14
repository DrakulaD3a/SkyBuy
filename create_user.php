<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('config.php');

['username' => $username, 'password' => $password, 'password-repeat' => $password_repeat] = $_POST;

$db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_USERNAME, DB_USERNAME, DB_PASSWORD);

if (!empty($username) && !empty($password)) {
	if ($password == $password_repeat) {
		if (is_password_valid($password)) {
			$stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?);");
			$stmt->execute([$username, $password]);
		}
	}
}

function is_password_valid(string $password): bool {
	$password_len = strlen($password);
	if ($password_len < 8) {
		return false;
	}

	$numbers = 0;
	$lowercase = false;
	$uppercase = false;
	for ($i = 0; $i < $password_len; $i++) {
		if (ctype_digit($password[$i])) {
			$numbers++;
		} elseif (ctype_lower($password[$i])) {
			$lowercase = true;
		} elseif (ctype_upper($password[$i])) {
			$uppercase = true;
		}

		if ($numbers >= 2 && $lowercase && $uppercase)  {
			return true;
		}
	}

	return false;
}
