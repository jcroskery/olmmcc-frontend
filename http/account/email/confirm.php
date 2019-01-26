<?php
require_once '/srv/http/helpers/accountFunctions.php';
require_once '/srv/http/helpers/displayMessage.php';
require_once '/srv/http/helpers/sendEmail.php';
require_once '/srv/http/helpers/wrapper.php';
include_once '/srv/http/helpers/sessionStart.php';
if (loggedIn()) {

    $_SESSION['newEmail'] = sanitizeString($_POST['newEmail']);
    $result = getAccountFromEmail($_SESSION['newEmail']);
    if ($result->num_rows > 0) {
        $row = $result->fetch_array(MYSQLI_NUM);
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
        sendEmail($subject, $message, $_SESSION['username'], $_SESSION['email']);
        $message = 'An email containing the confirmation link has been sent to ' . $_SESSION['email'] . '. Please check your email, including the spam folder, for the link. Please note that it may take a few minutes for the email to be sent.';
        displayMessage($message, '/account/email/confirm.php', 'Confirm email change', 'Resend confirmation email');
    }
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
} else {
    notLoggedIn();
}
