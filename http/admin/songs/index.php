<?php
include_once '/srv/http/helpers/songFunctions.php';
include_once '/srv/http/helpers/wrapper.php';
if($_SESSION['admin']){
    wrapperBegin('Song Database');

    $songs = getSongs();
    $tableContents = '';
    foreach ($songs as $song){
        $id = $song['id'];
        $name = $song['name'];
        $link = $song['link'];
        $notes = $song['notes'];
        $tableContents .= <<<HTML
        <tr>
            <form action='change/' method='post'>
                <td><input name='name' value='$name'/></td>
                <td><input name='link' value='$link'/></td>
                <td><input name='notes' value='$notes'/></td>
                <td><button type='submit' name='id' value='$id'>Save Changes</button></td>
            </form>
            <td>
                <form action='delete/' method='post'>
                    <button class='delete' name=$id value='delete'>Delete Song</button>
                </form>
            </td>
        <tr>
HTML;
    }
    echo <<<HTML
        <table class='database'>
            <caption>Song Database</caption>
        <tr>
            <th>Song Name</th>
            <th>Link</th>
            <th>Notes</th>
            <th colspan='2'>Options</th>
        </tr>
        $tableContents
        <tr>
            <form action='add/' method='post'>
                <td><input name='name' value='New Name'/></td>
                <td><input name='link' value='New Link'/></td>
                <td><input name='notes' value='New Notes'/></td>
                <td colspan='2' class='centerDiv'><button type='submit' name='add'>Add Song</button></td>
            </form>
        </tr>
        </table>
HTML;
    wrapperEnd('<script src="/js/alert.js"></script>', false);
} else {
    notLoggedIn();
}