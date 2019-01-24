<?php
class SongArticle{
    private $title, $body, $article, $expiry;
    function __construct($title, $body, $dmy){
        $this->title = $title;
        $this->body = $body;
        $this->expiry = DateTime::createFromFormat('d/m/Y', $dmy)->getTimestamp();
        $this->createArticle();
    }
    function createArticle(){
        
        $this->article = <<<HTML
        <h2>$this->title</h2>
            $this->body
HTML;
    }
    function getArticle(){
        return $this->article;
    }
    function getExpiry(){
        return $this->expiry;
    }
}