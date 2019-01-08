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