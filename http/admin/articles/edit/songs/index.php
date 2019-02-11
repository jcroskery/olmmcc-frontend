<?php
include_once '/srv/http/helpers/wrapper.php';
include_once '/srv/logincreds.php';
require_once '/srv/http/helpers/displayMessage.php';
include_once '/srv/http/helpers/songArticle.php';
if ($_SESSION['admin']) {
    $filepath = ('/srv/http/articles/songs/' . sanitizeString($_POST['edit']));
    $file = json_decode(file_get_contents($filepath), true);
    wrapperBegin($filepath);
    $text = $file['text'];
    echo <<<HTML
<div id='main-text'>
<h1>Edit $filepath</h1>
    <form class='centerDiv' action='../save/' method='post'>
        <label for='text'>Text:</label>
        <textarea class='largeTextarea' autofocus='autofocus' id='text'>$text</textarea>
        <br><br>
        <input type='submit' value='Save changes'/>
    </form>
</div>
HTML;
    wrapperEnd();
} else {
    notLoggedIn();
}
