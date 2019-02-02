<?php
class MainArticle extends BasicArticle{
    function __construct($filepath){
        $json = file_get_contents($filepath);
        $article = json_decode($json, true);
        $text = '<div id="main-text"><H1>' . $title .  '</H1><p>' . $article['text'] . '/<p></div>';
        parent::__construct($article['title'], $text);
    }
}