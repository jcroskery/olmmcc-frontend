<?php
include_once '/srv/http/helpers/wrapper.php';
include_once '/srv/http/helpers/basicArticle.php';
class MainArticle extends BasicArticle{
    function __construct($filepath){
        $json = file_get_contents($filepath);
        $article = json_decode($json, true);
        $text = '<div id="main-text"><H1>' . $article['title'] .  '</H1><p>' . $article['text'] . '</p></div>';
        parent::__construct($article['title'], $text);
        wrapperBegin($this->title, $article['topnavId']);
        echo $this->body;
        wrapperEnd();
    }
}