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
require_once '/srv/http/helpers/wrapper.php';
require_once '/srv/http/helpers/sessionStart.php';
require_once '/srv/http/helpers/sendEmail.php';
if(loggedIn()){
    $deleteCode;
    if ($_SESSION['deleteCode'] == '') {
        $deleteCode = hash('sha512', $_SESSION['email'] . bin2hex(random_bytes(20)));
        $_SESSION['deleteCode'] = $deleteCode;
    } else {
        $deleteCode = $_SESSION['deleteCode'];
    }
    $subject = "Delete OLMMCC account";
    $link = "http://" . $_SERVER['HTTP_HOST'] . "/account/delete/deleteAccount.php?deleteCode=3D" . $deleteCode;
    $message = "<p>Hi,</p>Click this link to delete your account. Caution! This action is permanent and irreversible.\r\n" . $link;
    sendEmail($subject, $message, $_SESSION['username'], $_SESSION['email']);
    $message = 'An email containing the link to delete your account has been sent to ' . $_SESSION['email'] . '. Please check your email, including the spam folder, for the link. Please note that it may take a few minutes for the email to be sent.';
    displayMessage($message, '/account/delete/', 'Confirm deletion', 'Resend confirmation email');
} else {
    notLoggedIn();
}