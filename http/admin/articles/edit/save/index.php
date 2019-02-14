<?php
include_once '/srv/http/helpers/wrapper.php';
include_once '/srv/logincreds.php';
require_once '/srv/http/helpers/displayMessage.php';
if ($_SESSION['admin']) {
    $name = sanitizeString($_POST['name']);
    echo $name;
} else {
    notLoggedIn();
}
