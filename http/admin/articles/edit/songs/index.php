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
        <label for='title'>Title: </label>
        <br>
        <input type='text' id='title' autofocus='autofocus' placeholder='Title displayed at the start of a song article.' name='title'/>
        <br><br>
        <label for='text'>Text:</label>
        <br>
        <textarea class='largeTextarea' placeholder='Text displayed as an intro to the song list.' name='text' id='text'>$text</textarea>
        <br><br>
        <label for='expiry'>Expiry:</label>
        <br>
        <input type='date' name='expiry' id='expiry'/>
        <br><br>
        <label>Songs:</label>
        <table class='database'>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Options</th>
            </tr>
            <tr>
                <td>
                    <input name='name' value='New Name'/>
                </td>
                <td>
                    <select name='type'>
                        <option value='songs'>Song Article</option>
                        <option value='main'>Main Article</option>
                    </select>
                </td>
                <td>
                    <button type='submit' name='$type' value=$file>Add New Article</button>
                </td>
            </tr>
        </table>
        <br>
        <input type='submit' value='Save changes'/>
    </form>
</div>
HTML;
    wrapperEnd();
} else {
    notLoggedIn();
}
