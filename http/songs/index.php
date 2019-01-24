<?php
include_once '../helpers/wrapper.php';
include_once '../helpers/songArticle.php';
$files = scandir('.');
$articleArray = [];
foreach($files as $file){
    if($file!="index.php"){
        include_once $file;
        if($expiry > time()){
            $articleArray[$expiry] = $article;
        }
        
    }  
}
ksort($articleArray);
$formatted = reset($articleArray);
if($formatted == ''){
    $formatted = <<<HTML
    <p>There is no post about the current schedule yet, please check back later.</p>
HTML;
}
wrapperBegin('Songs', 'songs');
echo <<<HTML
<div id="main-text">
    <h1>Practice Information</h1>
    $formatted
</div>
HTML;
wrapperEnd('<script src="/js/songs.js"></script>');
