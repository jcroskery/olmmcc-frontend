<?php
include_once '/srv/http/helpers/basicArticle.php';

class SongArticle extends BasicArticle{
    public $article, $expiry;
    function __construct($title, $body, $dmy){
        parent::__construct($title, $body);
        $this->expiry = DateTime::createFromFormat('d/m/Y', $dmy)->getTimestamp();
        $this->createArticle();
    }
    function createArticle(){
        
        $this->article = <<<HTML
        <h2>$this->title</h2>
            $this->body
HTML;
    }
}