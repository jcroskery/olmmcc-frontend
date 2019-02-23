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
include_once '/srv/http/helpers/wrapper.php';
include_once '/srv/logincreds.php';
require_once '/srv/http/helpers/displayMessage.php';
include_once '/srv/http/helpers/songArticle.php';
if ($_SESSION['admin']) {
    $filepath = ('/srv/http/articles/songs/' . sanitizeString($_POST['edit']));
    $file = json_decode(file_get_contents($filepath), true);
    wrapperBegin($filepath);
    $title = $file['title'];
    $text = $file['text'];
    $expiry = isset($file['expiry']) ? date("Y-m-d",$file['expiry']) : date("Y-m-d", strtotime("first sunday of next month"));
    echo <<<HTML
<div id='main-text'>
<h1>Edit $filepath</h1>
    <form class='centerDiv' action='../save/' method='post'>
        <label for='title'>Title: </label>
        <br>
        <input type='text' id='title' autofocus='autofocus' placeholder='Title displayed at the start of a song article.' name='title' value='$title'/>
        <br><br>
        <label for='text'>Text:</label>
        <br>
        <textarea class='largeTextarea' placeholder='Text displayed as an intro to the song list.' name='text' id='text'>$text</textarea>
        <br><br>
        <label for='expiry'>Expiry:</label>
        <br>
        <input type="text" name="expiry" value = '$expiry' placeholder="YYYY-MM-DD" id='expiry' pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" 
title="Enter a date in this format YYYY-MM-DD"/>
        <br><br>
        <input type='submit' value='Save changes'/>
        <br><br><br>
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
                    <input name='role' value='New Role'/>
                </td>
                <td>
                    <button type='submit' name='$type' value=$file>Add New Song</button>
                </td>
            </tr>
        </table>
    </form>
</div>
HTML;
    wrapperEnd();
} else {
    notLoggedIn();
}
