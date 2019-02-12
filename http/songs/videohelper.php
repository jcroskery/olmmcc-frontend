<?php
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