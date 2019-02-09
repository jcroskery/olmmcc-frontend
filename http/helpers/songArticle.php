<?php
include_once '../helpers/wrapper.php';
include_once '/srv/http/helpers/songFunctions.php';
include_once '/srv/http/songs/videohelper.php';

function createSongArticle($location) {
    $file = fopen($location, 'w');
    $json = <<<JSON
{
    "title" : "",
    "text" : "",
    "expiry" : ""
}
JSON;
    fwrite($file, $json);
    fclose($file);
}
function displaySongArticle($article){
    wrapperBegin('Current Songs', 'songs');
    echo <<<HTML
    <div id="main-text">
        <h1>This Month's Songs</h1>
HTML;
    if($article['expiry'] < time() || !isset($article)){
        echo '<p>There is no post about the current songs yet, please check back later.</p>';
    } else {
        echo '<h2>' . $article['title'] . '</h2>';
        echo "<p>" . $article['text'] . "</p>";
        foreach($article as $role => $song){
            $songData = getSong($song);
            if($songData){
                echo createVideo($song, $role, $songData[2]);
            }
        }
    }
    echo '</div>';
    wrapperEnd('<script src="/js/songs.js"></script>');
}