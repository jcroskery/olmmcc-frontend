<?php
session_start();
require_once '/srv/logincreds.php';
require_once '/srv/http/helpers/displayMessage.php';
if ($_SESSION['id'] != '') {
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) {
        die("Connection error");
    }

    $stmt = $connection->prepare("SELECT * FROM userlist WHERE id = ?");
    $stmt->bind_param("s", $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array(MYSQLI_NUM);
    $_SESSION['verified'] = $row[4];
    $_SESSION['email'] = $row[0];
    $_SESSION['username'] = $row[1];
    $_SESSION['admin'] = $row[5];
    $_SESSION['subscription_policy'] = $row[6];
    $_SESSION['invalid_email'] = $row[7];
} else {
    $message = 'Error, you are not logged in. Please log in.';
    displayPopupNotification($message, '/login/');
}
