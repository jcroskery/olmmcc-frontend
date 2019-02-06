<?php
include_once '../helpers/songArticle.php';

$files = scandir('/srv/http/articles/songs/');
$article;
foreach($files as $file){
    $json = json_decode(file_get_contents('/srv/http/articles/songs/' . $file), true);
    if(!isset($article) || $article['expiry'] <= $json['expiry']){
        $article = $json;
    }    
}
songArticle($article);
