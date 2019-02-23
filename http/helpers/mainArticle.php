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
function createMainArticle($location)
{
    $file = fopen($location, 'w');
    $json = <<<JSON
{
    "title" : "",
    "text" : "",
    "topnavId" : ""
}
JSON;
    fwrite($file, $json);
    fclose($file);
}

function displayMainArticle($filepath) {
    $json = file_get_contents($filepath);
    $article = json_decode($json, true);
    $text = '<div id="main-text"><H1>' . $article['title'] .  '</H1>' . $article['text'] . '</div>';
    wrapperBegin($article['title'], $article['topnavId']);
    echo $text;
    wrapperEnd();
}