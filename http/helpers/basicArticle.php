<?php
class BasicArticle{
    private $title, $body, $article, $expiry;
    function __construct($title, $body, $dmy){
        $this->title = $title;
        $this->body = $body;
        $this->expiry = DateTime::createFromFormat('d/m/Y', $dmy)->getTimestamp();
        $this->createArticle();
    }
    function createArticle(){
        
        $this->article = <<<HTML
        <p id="article-info">$this->title</p>
        <div id="article-text">
            $this->body
        </div>
HTML;
    }
    function getArticle(){
        return $this->article;
    }
    function getExpiry(){
        return $this->expiry;
    }
}