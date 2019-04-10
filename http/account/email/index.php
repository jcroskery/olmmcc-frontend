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
require_once '/srv/http/api/database/accessTable.php';
require_once '/srv/http/helpers/displayMessage.php';
require_once '/srv/http/api/email/queueEmail.php';
require_once '/srv/http/helpers/wrapper.php';
if (loggedIn()) {
    $_SESSION['newEmail'] = $_POST['newEmail'];
    if (getRow('users', 'email', $_SESSION['newEmail'])) {
        if ($_SESSION['email'] == $_SESSION['newEmail']) {
            $message = "This email address is already registered to this account.";
            displayPopupNotification($message, '/account/');
        } else {
            $message = "Sorry, your chosen email address has already been registered. Please log in to your account.";
            displayPopupNotification($message, '/login/');
        }
    } else {
        $emailCode;
        if ($_SESSION['changeEmailVerificationId'] == '') {
            $emailCode = hash('sha512', $row[0] . bin2hex(random_bytes(20)));
            $_SESSION['changeEmailVerificationId'] = $emailCode;
        } else {
            $emailCode = $_SESSION['changeEmailVerificationId'];
        }
        $subject = "Email change request";
        $link = "http://" . $_SERVER['HTTP_HOST'] . "/account/email/changeEmail.php?changeEmailVerificationId=3D" . $emailCode;
        $message = "<p>Hi,</p>Click this link to change your email address: " . $link;
        queueEmail($subject, $message, $_SESSION['username'], $_SESSION['email']);
        $message = 'An email containing the confirmation link has been sent to ' . $_SESSION['email'] . '. Please check your email, including the spam folder, for the link. Please note that it may take a few minutes for the email to be sent.';
        displayMessage($message, '/account/email/confirm.php', 'Confirm email change', 'Resend confirmation email');
    }
} else {
    notLoggedIn();
}
