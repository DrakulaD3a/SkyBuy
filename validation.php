<?php

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

        if ($numbers >= 2 && $lowercase && $uppercase) {
            return true;
        }
    }

    return false;
}

function is_username_available(string $username, $db): bool {
    $query = $db->prepare("SELECT * FROM users WHERE username = ?;");
    $query->execute([$username]);
    return $query->rowCount() == 0;
}

function login(string $username, string $password, $db): bool {
    $query = $db->prepare("SELECT * FROM users WHERE username = ? and password = ?");
    $query->execute([$username, md5($password)]);
    return $query->rowCount() == 1;
}
