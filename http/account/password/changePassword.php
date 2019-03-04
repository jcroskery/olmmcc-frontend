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
require_once '/srv/logincreds.php';
require_once '/srv/http/api/session/sessionStart.php';
if(htmlspecialchars($_SESSION['passwordChangeRequest']) == $_GET['passwordChangeRequest']){
    $connection = new mysqli($hn, $un, $pw, $db);
    if($connection->connect_error) die("Connection error");
    $stmt = $connection->prepare("update userlist set password=? where id=?");
    $stmt->bind_param("ss", $_SESSION['newHashedPassword'], $_SESSION['newPasswordId']);
    $stmt->execute();
    session_unset();
    $message = "Your password was successfully changed. Please login to your account.";
    displayPopupNotification($message, '/login/');
} else {
    $message = "An error occurred. Please resend the email or contact the webmaster.";
    displayPopupNotification($message, '/login/');
}