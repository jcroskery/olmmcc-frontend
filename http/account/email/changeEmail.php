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
require_once '/srv/http/api/database/accessTable.php';
session_start();
if(htmlspecialchars($_SESSION['changeEmailVerificationId']) == $_GET['changeEmailVerificationId']){
    changeRow('users', $_SESSION['id'], 'email', $_SESSION['newEmail']);
    //Set email not invalid
    changeRow('users', $_SESSION['id'], 'verified', 0);
    session_unset();
    $message = "Your email was successfully changed. Please login to your account and verify it.";
    displayPopupNotification($message, '/login/');
} else {
    $message = "An error occurred. Please try to login again or contact the webmaster.";
    displayPopupNotification($message, '/login/');
}