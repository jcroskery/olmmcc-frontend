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
function youtube($video){
    return <<<HTML
    '<div id=iframe-popup><iframe class=iframe src=$video frameborder=0 allowfullscreen></iframe></div>'
HTML;
}
function ownvideo($video){
    return <<<HTML
    '<div id=iframe-popup><video class=iframe src=$video controls></video></div>'
HTML;
}
function createVideo($name, $role, $link){
    $video;
    if(preg_match('/https.*/', $link)){
        $video = youtube($link);
    } else {
        $video = ownvideo($link);
    }
    return <<<HTML
    <h4>$role: <a href="javascript:;" id="$video" class='songLink'>$name</a></h4>
    HTML;
}