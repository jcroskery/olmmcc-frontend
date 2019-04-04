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
require_once '/srv/http/api/account/accountFunctions.php';
refreshAccount();
header("Refresh: 15;url='/account/verify/'");
if ($_SESSION['id'] != '') {
    if (!$_SESSION['verified']) {
        $files = scandir('/srv/http/json/incoming/');
        foreach ($files as $file) {
            if ($file == 'Email does not exist' . $_SESSION['notVerifiedEmail'] . '.json') {
                setInvalidEmail($_SESSION['id']);
                unlink('/srv/http/json/incoming/' . $file);
                $_SESSION['invalid_email'] = '1';
            }
        }
        if($_SESSION['invalid_email'] == 1){
            /*
} else if ($_SESSION['invalid_email'] == 1) {
    $_SESSION['newEmail'] = sanitizeString($_POST['newEmail']);
    $result = getAccountFromEmail($_SESSION['newEmail']);
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
            $message = 'Your account has not been verified yet. An email containing the verification link has been sent to ' . $_SESSION['notVerifiedEmail'] . '. Please note that it may take a few minutes for the email to be sent.';
            displayMessage($message, '/account/verify/email.php', 'Verify your account', 'Resend Verification Email');
        }
    } else {
        $message = 'Your account has already been verified.';
        displayPopupNotification($message, '/');
    }

} else {
    $message = 'You are not logged in. Please log in.';
    displayPopupNotification($message, '/login/');
}
