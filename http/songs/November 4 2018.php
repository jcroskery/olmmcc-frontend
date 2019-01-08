<?php
$article = <<<HTML
<p>Sunday, November 4th is our next performance! Choir members, please be there for 8:30 AM if possible! Below are the songs we will be playing:</p>
<h4>Multiplied</h4>
<div class="iframe-container">
    <iframe width="560" height="315" src="https://www.youtube.com/embed/fGF-MGGLpB0" allow="encrypted-media" allowfullscreen></iframe>
</div>

<h4>How Great is our God</h4>
<div class="iframe-container">
    <iframe width="560" height="315" src="https://www.youtube.com/embed/KBD18rsVJHk" allow="encrypted-media" allowfullscreen></iframe>
</div>
<h4>Communion</h4>
<div class="iframe-container">
    <iframe width="560" height="315" src="https://www.youtube.com/embed/5x6khRQFlOc" allow="encrypted-media" allowfullscreen></iframe>
</div>
<h4>Every Move I Make</h4>
<div class="iframe-container">
    <iframe width="560" height="315" src="https://www.youtube.com/embed/Dgf1YzscBlE" allow="encrypted-media" allowfullscreen></iframe>
</div>
HTML;

$tmp = new BasicArticle("Below are the songs for our November 4th children's mass:", $article, '5/11/2018');
$expiry = $tmp->getExpiry();
$article = $tmp->getArticle();