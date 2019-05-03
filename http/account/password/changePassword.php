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
include_once '/srv/http/helpers/displayMessage.php';
require_once '/srv/http/api/session/sessionStart.php';
require_once '/srv/http/helpers/wrapper.php';
require_once '/srv/http/api/database/accessTable.php';
require_once '/srv/http/api/account/validationFunctions.php';
if (loggedIn()) {
    $correctPassword = getRow('users', 'id', $_SESSION['id'])['password'];
    if(password_verify($_POST['currentPassword'], $correctPassword)){
        if (!checkPasswords($_POST['newPassword1'], $_POST['newPassword2'], '/account/')) {return;}
        changeRow('users', $_SESSION['id'], 'password', password_hash($_POST['newPassword1'], PASSWORD_DEFAULT));
        session_unset();
        $message = "Your password was successfully changed. Please login to your account with your new password.";
        displayPopupNotification($message, '/login/');
    } else {
        $message = "Wrong password. Please try again.";
        displayPopupNotification($message, '/account/');
    }
} else if (htmlspecialchars($_SESSION['passwordChangeRequest']) == $_GET['passwordChangeRequest']) {
    //This was for people who weren't logged in---now it doesn't work

} else {
    notLoggedIn();
}
