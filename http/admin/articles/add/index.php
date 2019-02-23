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
include_once '/srv/http/helpers/mainArticle.php';
if ($_SESSION['admin']) {
    $name = sanitizeString($_POST['name']);
    $type = sanitizeString($_POST['type']);
    $path = '/srv/http/articles/' . ($type=='songs' ? 'songs/' : 'main/');
    $fullpath = $path . $name . '.json';
    if(file_exists($fullpath)){
        $message = "This article already exists, sorry!";
        displayPopupNotification($message, '/admin/articles');
    } else {
        if($type=='songs'){
            createSongArticle($fullpath);
        } else {
            createMainArticle($fullpath);
        }
        $message = "Sucessfully added " . $name . ".";
        displayPopupNotification($message, '/admin/articles');
    }
} else {
    notLoggedIn();
}
