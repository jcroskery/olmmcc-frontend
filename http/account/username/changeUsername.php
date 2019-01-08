<?php
session_start();
require_once '/srv/logincreds.php';
require_once '/srv/http/helpers/displayMessage.php';
require_once '/srv/http/helpers/wrapper.php';
if (loggedIn()) {
    $newUsername = sanitizeString($_POST['newUsername']);
    if ($newUsername != '') {
        $connection = new mysqli($hn, $un, $pw, $db);
        if ($connection->connect_error) {
            die("Connection error");
        }
        $stmt = $connection->prepare("SELECT * FROM userlist WHERE username=?");
        $stmt->bind_param("s", $newUsername);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_array(MYSQLI_NUM);
            if ($row[1] == $newUsername) {
                $message = "This username is already registered to your account.";
                displayPopupNotification($message, '/account/');
            } else {
                $message = "Sorry, this username has already been taken. Please select another.";
                displayPopupNotification($message, '/account/username/');
            }
        } else {
            $stmt = $connection->prepare("update userlist set username=? where id=?");
            $stmt->bind_param("ss", $newUsername, $_SESSION['id']);
            $stmt->execute();
            $_SESSION['username'] = $newUsername;
            header("location: /account/");
        }
    } else {
        $message = 'An error occurred, please try again.';
        displayPopupNotification($message, '/account/username/');
    }
} else {
    notLoggedIn();
}
