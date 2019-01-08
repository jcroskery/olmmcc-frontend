<?php
include_once '/srv/http/helpers/wrapper.php';
include_once '/srv/logincreds.php';
include_once '/srv/http/helpers/displayMessage.php';
$subscriptionOptions = ['You are now unsubscribed from receiving emails.', 'You are now subscribed to receive emails.', 'You are now subscribed to receive emails and reminders.'];
if (loggedIn()) {
    $subscription_policy = sanitizeString($_POST['subscriptionPolicy']);
    if ($subscription_policy > -1 && $subscription_policy < 3) {
        $connection = new mysqli($hn, $un, $pw, $db);
        if ($connection->connect_error) {
            die("Connection error");
        }

        $stmt = $connection->prepare("update userlist set subscription_policy=? where email=?");
        $stmt->bind_param("ss", $subscription_policy, $_SESSION['email']);
        $stmt->execute();
        $_SESSION['subscription_policy'] = $subscription_policy;
        $message = 'Subscription policy updated successfully! ' . 
        $subscriptionOptions[$subscription_policy];
        displayPopupNotification($message, '/account/');
    } else {
        $message = 'Error, invalid subscription policy! Please try again';
        displayPopupNotification($message, '/account/');
    }
} else {
    notLoggedIn();
}
