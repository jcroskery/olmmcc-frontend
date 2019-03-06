<?php
/*
Copyright (C) 2019  Justus Croskery
To contact me, email me at justus@olmmcc.tk.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see https://www.gnu.org/licenses/.
*/
include_once '/srv/http/api/songs/songFunctions.php';
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