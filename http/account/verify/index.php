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
require_once '/srv/http/api/database/accessTable.php';
require_once '/srv/http/api/account/accountFunctions.php';
require_once '/srv/http/api/email/queueEmail.php';
refreshAccount();
if ($_SESSION['id'] != '') {
    if (!$_SESSION['verified']) {
        /*
        $files = scandir('/srv/http/json/incoming/');
        foreach ($files as $file) {
        if ($file == 'Email does not exist' . $_SESSION['notVerifiedEmail'] . '.json') {
        changeRow('users', $_SESSION['id'], 'invalid_email', 1);
        unlink('/srv/http/json/incoming/' . $file);
        $_SESSION['invalid_email'] = '1';
        }
        }
         */
        if ($_SESSION['invalid_email'] == 1) {
            /*
        } else if ($_SESSION['invalid_email'] == 1) {
        $_SESSION['newEmail'] = sanitizeString($_POST['newEmail']);
        $result = Get Account From Email ($_SESSION['newEmail']);
        if ($result->num_rows > 0) {
        $row = $result->fetch_array(MYSQLI_NUM);
        if ($_SESSION['notVerifiedEmail'] == $_SESSION['newEmail']) {
        $message = "This email address is already registered to this account.";
        displayPopupNotification($message, '/account/email/');
        } else {
        $message = "Sorry, your email address has already been registered. Please use a different one.";
        displayPopupNotification($message, '/account/email');
        }

        } else {
        $_SESSION['changeEmailVerificationId'] = 0;
        refreshAccount();
        header('location: /account/email/changeEmail.php?changeEmailVerificationId=' . $_SESSION['changeEmailVerificationId']);
        }
         */
        } else {
            $verificationid;
            if ($_SESSION['verificationid'] == '') {
                $verificationid = hash('sha512', $_SESSION['id'] . bin2hex(random_bytes(20)));
                $_SESSION['verificationid'] = $verificationid;
            } else {
                $verificationid = $_SESSION['verificationid'];
            }

            $subject = "Verify your account";
            $link = "http://" . $_SERVER['HTTP_HOST'] . "/account/verify/verify.php?verification=3D" . $verificationid;
            $message = "<p>Hi,</p>Here is your verification link: " . $link;
            queueEmail($subject, $message, $_SESSION['notVerifiedUsername'], $_SESSION['notVerifiedEmail']);
            $message = 'An email containing an link to verify your account has been sent to ' . $_SESSION['notVerifiedEmail'] . '. Please check your inbox, including the spam folder, for the link. It may take a few minutes to receive the email.';
            displayPopupNotification($message, '/login/');
        }
    } else {
        $message = 'Your account has already been verified.';
        displayPopupNotification($message, '/');
    }

} else {
    $message = 'You are not logged in. Please log in.';
    displayPopupNotification($message, '/login/');
}
