<?php
include_once '../helpers/wrapper.php';
include_once '../helpers/songArticle.php';

$files = scandir('/srv/http/articles/songs/');
$articleArray = [];
foreach($files as $file){
    
        
    if($songArticle->expiry > time()){
        $articleArray[$songArticle->title] = $songArticle;
    }
        
}
ksort($articleArray);
$formatted = reset($articleArray)->article;
if($formatted == ''){
    $formatted = <<<HTML
    <p>There is no post about the current schedule yet, please check back later.</p>
HTML;
}
wrapperBegin(reset($articleArray)->title, 'songs');
echo <<<HTML
<div id="main-text">
    <h1>Practice Information</h1>
    $formatted
</div>
HTML;
wrapperEnd('<script src="/js/songs.js"></script>');
