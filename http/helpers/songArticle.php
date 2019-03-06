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
include_once '../helpers/wrapper.php';
include_once '/srv/http/api/songs/songFunctions.php';
include_once '/srv/http/songs/videohelper.php';
function createSongArticle($location) {
    $file = fopen($location, 'w');
    $json = <<<JSON
{
    "title" : "",
    "text" : "",
    "expiry" : ""
}
JSON;
    fwrite($file, $json);
    fclose($file);
}
function displaySongArticle($article){
    wrapperBegin('Current Songs', 'songs');
    echo <<<HTML
    <div id="main-text">
        <h1>This Month's Songs</h1>
HTML;
    if($article['expiry'] < time() || !isset($article)){
        echo '<p>There is no post about the current songs yet, please check again soon!</p>';
    } else {
        echo '<h3>' . $article['title'] . '</h3>';
        echo "<p>" . $article['text'] . "</p>";
        foreach($article as $role => $song){
            $songData = getSong($song);
            if($songData){
                echo createVideo($song, $role, $songData[2]);
            }
        }
    }
    echo '</div>';
    wrapperEnd('<script src="/js/songs.js"></script>');
}