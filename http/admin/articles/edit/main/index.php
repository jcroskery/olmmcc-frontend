<?php
include_once '/srv/http/helpers/wrapper.php';
include_once '/srv/logincreds.php';
require_once '/srv/http/helpers/displayMessage.php';
include_once '/srv/http/helpers/mainArticle.php';
if ($_SESSION['admin']) {
    $filepath = ('/srv/http/articles/main/' . sanitizeString($_POST['edit']));
    $file = json_decode(file_get_contents($filepath), true);
    print_r($file);
} else {
    notLoggedIn();
}
