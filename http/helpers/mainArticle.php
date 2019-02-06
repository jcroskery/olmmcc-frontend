<?php
include_once '/srv/http/helpers/wrapper.php';
function mainArticle($filepath) {
    $json = file_get_contents($filepath);
    $article = json_decode($json, true);
    $text = '<div id="main-text"><H1>' . $article['title'] .  '</H1>' . $article['text'] . '</div>';
    wrapperBegin($article['title'], $article['topnavId']);
    echo $text;
    wrapperEnd();
}