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
require_once '/srv/http/api/database/accessTable.php';
require_once '/srv/http/api/notification/displayNotification.php';
$email = strtolower($_POST['email']);
$password = $_POST['password'];
$row = getRow('users', 'email', $email);
if (password_verify($password, $row['password'])) {
    session_unset();
    $_SESSION['id'] = $row['id'];
    $_SESSION['verified'] = $row['verified'];
    $_SESSION['invalid_email'] = $row['invalid_email'];
    if ($row['verified']) {
        $_SESSION['email'] = $row['email'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['admin'] = $row['admin'];
        $_SESSION['subscription_policy'] = $row['subscription_policy'];
        $message = 'Successfully logged in!';
        displayPopupNotification($message, '/');
    } else {
        $_SESSION['notVerifiedEmail'] = $row['email'];
        $_SESSION['notVerifiedUsername'] = $row['username'];
        header('location: /account/verify/');
    }
} else {
    $message = "Wrong email or password, please try again.";
    displayPopupNotification($message, '/login/');
}