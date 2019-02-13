<?php
include_once '/srv/http/helpers/songFunctions.php';
include_once '/srv/http/helpers/wrapper.php';
if(loggedIn()){
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
            <td><input name='name' value='$name'/><button type='submit' name=$id value='name'>Change Name</button></td>
            <td><input name='link' value='$link'/><button type='submit' name=$id value='link'>Change Link</button></td>
            <td><input name='notes' value='$notes'/><button type='submit' name=$id value='notes'>Change Notes</button></td>
            </form>
            <form action='delete/' method='post'>
            <td><button class='delete' name=$id value='delete'>Delete Song</button></td>
            </form>
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
            <th>Options</th>
        </tr>
        $tableContents
        <tr>
            <form action='add/' method='post'>
                <td><input name='name' value='New Name'/></td>
                <td><input name='link' value='New Link'/></td>
                <td><input name='notes' value='New Notes'/></td>
                <td><button type='submit' name='add'>Add Song</button></td>
            </form>
        </tr>
        </table>
HTML;
    wrapperEnd('<script src="/js/alert.js"></script>', false);
} else {
    notLoggedIn();
}