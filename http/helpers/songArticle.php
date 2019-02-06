<?php
include_once '../helpers/wrapper.php';

function songArticle($article){
    wrapperBegin('Current Songs', 'songs');
    echo <<<HTML
    <div id="main-text">
        <h1>This Month's Songs</h1>
HTML;
    if($article['expiry'] < time() || !isset($article)){
        echo '<p>There is no post about the current songs yet, please check back later.</p>';
    } else {
        echo '<h2>' . $article['title'] . '</h2>';
        echo "<p>Our practices this month will be on Thursday, January 17th and Thursday, January 31rd. Below are the songs we will be singing at the Children's Mass on February 3rd:</p>";
    }
    echo '</div>';
    wrapperEnd('<script src="/js/songs.js"></script>');
}