<?php

if (empty($_POST)) {
	header("Location: register.php");
}

session_start();

require_once "config.php";

[
    "username" => $username,
    "password" => $password,
    "password-repeat" => $password_repeat,
] = $_POST;
$username = strtolower($username);

$db = new PDO(
    "mysql:host=" . DB_HOST . ";dbname=" . DB_USERNAME,
    DB_USERNAME,
    DB_PASSWORD
);

// TODO: Redirect back after failed login
if (!empty($username) && !empty($password)) {
    if ($password == $password_repeat) {
        if (is_password_valid($password)) {
            if (is_username_available($username, $db)) {
                $stmt = $db->prepare(
                    "INSERT INTO users (username, password) VALUES (?, ?);"
                );
                $stmt->execute([$username, md5($password)]);

                $_SESSION["username"] = $username;
                header("Location: index.php");
            } else {
                echo "Username already exists";
            }
        } else {
            echo "Password is not valid";
        }
    } else {
        echo "Passwords do not match";
    }
    
}

echo " <a href=\"register.php\">go back</a>";

function is_password_valid(string $password): bool
{
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

        if ($numbers >= 2 && $lowercase && $uppercase) {
            return true;
        }
    }

    return false;
}

function is_username_available(string $username, $db): bool
{
    $query = $db->prepare("SELECT * FROM users WHERE username = ?;");
    $query->execute([$username]);
    return $query->rowCount() == 0;
}
