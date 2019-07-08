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
require_once '/srv/http/api/notification/displayNotification.php';
session_start();
require_once '/srv/http/api/database/accessTable.php';
require_once '/srv/http/api/account/validationFunctions.php';
if ($_SESSION['verified']) {
    $correctPassword = getRow('users', 'id', $_SESSION['id'])['password'];
    if(password_verify($_POST['currentPassword'], $correctPassword)){
        if (!checkPasswords($_POST['newPassword1'], $_POST['newPassword2'], '/account/')) {return;}
        changeRow('users', $_SESSION['id'], 'password', password_hash($_POST['newPassword1'], PASSWORD_DEFAULT));
        $message = "Your password was successfully changed!";
        echo json_encode(['message' => $message]);
    } else {
        $message = "Wrong password. Please try again.";
        echo json_encode(['message' => $message]);
    }
} else if (htmlspecialchars($_SESSION['passwordChangeRequest']) == $_GET['passwordChangeRequest']) {
    //This was for people who weren't logged in---now it doesn't work

}
