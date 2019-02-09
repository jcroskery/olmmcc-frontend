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
        $tableContents .= <<<HTML
        <tr>
            <form action='/admin/songs/changeSong.php' method='post'>
            <td><input type='textarea' name='name' value='$name'/><button type='submit' name=$id value='name'>Change Name</button></td>
            <td><input type='textarea' name='link' value='$link'/><button type='submit' name=$id value='link'>Change Link</button></td>
            </form>
            <form action='/admin/songs/deleteSong.php' method='post'>
            <td><button type='submit' name=$id value='delete' class='delete'>Delete Song</button></td>
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
            <th>Options</th>
        </tr>
        $tableContents
        <tr>
            <form action='addSong.php' method='post'>
                <td><input type='textarea' name='name' value='New Name'/></td>
                <td><input type='textarea' name='link' value='New Link'/></td>
                <td><button type='submit' name='add'>Add Song</button></td>
            </form>
        </tr>
        </table>
HTML;
    wrapperEnd('', false);
}