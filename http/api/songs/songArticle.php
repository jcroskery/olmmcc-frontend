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
include_once '/srv/http/api/songs/songFunctions.php';
include_once 'videohelper.php';
function displaySongArticle($article)
{
    wrapperBegin('Current Songs', 'songs');
    echo <<<HTML
    <div id="main-text">
        <h1>This Month's Songs</h1>
HTML;
    if ($article['expiry'] < time() || !isset($article)) {
        echo '<p>There is no post about the current songs yet, please check again soon!</p>';
    } else {
        echo '<h3>' . $article['title'] . '</h3>';
        echo "<p>" . $article['text'] . "</p>";
        foreach (getAllRows('songs') as $song) {
            if ($song['article'] == $article['title']) {
                if ($song['name']) {
                    echo createVideo($song['name'], $song['role'], $song['link']);
                }
            }
        }
    }
    echo '</div>';
    wrapperEnd('<script src="/js/songs.js"></script>');
}
