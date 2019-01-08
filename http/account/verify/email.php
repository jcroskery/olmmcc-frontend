<?php
require_once '/srv/http/helpers/sendEmail.php';
session_start();
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
sendEmail($subject, $message, $_SESSION['notVerifiedUsername'], $_SESSION['notVerifiedEmail']);
header('location: /account/verify/');