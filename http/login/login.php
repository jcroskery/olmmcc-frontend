<?php
/*
Copyright (C) 2019  Justus Croskery
To contact me, email me at justus@olmmcc.tk.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see https://www.gnu.org/licenses/.
*/
include_once '/srv/http/api/session/sessionStart.php';
require_once '/srv/logincreds.php';
require_once '/srv/http/helpers/displayMessage.php';
$connection = new mysqli($hn, $un, $pw, $db);
if ($connection->connect_error) {
    die("Connection error");
}

$email = strtolower(sanitizeString($_POST['email']));
$password = sanitizeString($_POST['password']);
$stmt = $connection->prepare("SELECT * FROM userlist WHERE email = ?");

$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_array(MYSQLI_NUM);
if (password_verify($password, $row[2])) {
    session_unset();
    $_SESSION['id'] = $row[3];
    $_SESSION['verified'] = $row[4];
    $_SESSION['invalid_email'] = $row[7];
    if ($row[4]) {
        $_SESSION['email'] = $row[0];
        $_SESSION['username'] = $row[1];
        $_SESSION['admin'] = $row[5];
        $_SESSION['subscription_policy'] = $row[6];
        $message = 'Successfully logged in!';
        displayPopupNotification($message, '/');
    } else {
        $_SESSION['notVerifiedEmail'] = $row[0];
        $_SESSION['notVerifiedUsername'] = $row[1];
        header('location: /account/verify/email.php');
    }

} else {
    $message = "Wrong email or password, please try again.";
    displayPopupNotification($message, '/login/');
}
