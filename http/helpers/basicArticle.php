<?php
class BasicArticle {
    protected $title, $body;
    function __construct($title, $body){
        $this->title = $title;
        $this->body = $body;
    }
}