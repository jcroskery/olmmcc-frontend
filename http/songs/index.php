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

$formatted;
if(strtotime($article['expiry']) < time() || !isset($article)){
    
    $formatted = <<<HTML
    <p>There is no post about the current schedule yet, please check back later.</p>
HTML;
} else {
    $formatted = <<<HTML

HTML;
}

wrapperBegin($article['title'], 'songs');
echo <<<HTML
<div id="main-text">
    <h1>This Month's Songs</h1>
    $formatted
</div>
HTML;
wrapperEnd('<script src="/js/songs.js"></script>');
