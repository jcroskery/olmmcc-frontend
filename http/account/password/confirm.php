<?php
require_once '/srv/logincreds.php';
require_once '/srv/http/helpers/displayMessage.php';
require_once '/srv/http/helpers/sendEmail.php';
$email = sanitizeString($_POST['email']);
$password = sanitizeString($_POST['password']);
$password1 = sanitizeString($_POST['password1']);
$stmt = $connection->prepare("SELECT * FROM userlist WHERE email = ?");
    
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_array(MYSQLI_NUM);
if($row[1] != null){
    if($password==$password1){
        $username = $row[1];
        $_SESSION['newHashedPassword'] = password_hash($password, PASSWORD_DEFAULT);
        $_SESSION['newPasswordId'] = $row[3];
        $passwordChangeRequest = hash('sha512', $row[3] . bin2hex(random_bytes(20)));
        $_SESSION['passwordChangeRequest'] = $passwordChangeRequest;
        $subject = "Password change request";
        $link = "https://" . $_SERVER['HTTP_HOST'] . "/account/password/changePassword.php?passwordChangeRequest=3D" . $passwordChangeRequest;
        $message = "<p>Hi,</p>Click this link to change your password: " . $link;
        sendEmail($subject, $message, $username, $email);
        $message = 'An email containing the password reset link has been sent to ' . $email . '. Please check your email for the link, including the spam folder. Please note that it may take a few minutes for the email to be sent.';
        displayError($message, '/account/password/confirm.php', 'Password change link sent', 'Resend confirmation email');
    } else {
        $message = "Passwords do not match. Please try again.";
        displayPopupNotification($message, '/account/password/');
    }
} else {
    $message = "Email not found in our database. Please try again.";
    displayPopupNotification($message, '/account/password/');
}