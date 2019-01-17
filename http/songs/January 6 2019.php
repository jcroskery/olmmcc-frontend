<?php
include_once 'videohelper.php';
$ohcomeallyefaithful = youtube('https://www.youtube.com/embed/Q8dgI4-bVPU');
$angelswehaveheardonhigh = youtube('https://www.youtube.com/embed/X2McgKkUChA');
$wethreekings = ownvideo('/videos/wethreekings.m4v');
$howmanykings = youtube('https://www.youtube.com/embed/5UyiAnUE53U');
$silentnight = youtube('https://www.youtube.com/embed/UNpiQwgStNA');
$gotellitonthemountain = youtube('https://www.youtube.com/embed/72LE487YZ-U');
$article = <<<HTML

<p>Our practices will be on Thursday, December 6th, Thursday, December 13th, and Thursday, January 3rd. Below are the songs we will be singing at the Children's Mass on January 6th:</p>

<h4>Processional: <a href="javascript:;" onclick="displayPopupVideo($ohcomeallyefaithful)">Oh Come All Ye Faithful</a></h4>
<h4>Gloria: <a href="javascript:;" onclick="displayPopupVideo($angelswehaveheardonhigh)">Angels We Have Heard On High</a></h4>
<h4>Offertory: <a href="javascript:;" onclick="displayPopupVideo($wethreekings)">We Three Kings</a></h4>
<h4>Communion: <a href="javascript:;" onclick="displayPopupVideo($howmanykings)">How Many Kings</a></h4>
<h4>Communion: <a href="javascript:;" onclick="displayPopupVideo($silentnight)">Silent Night</a></h4>
<h4>Recessional: <a href="javascript:;" onclick="displayPopupVideo($gotellitonthemountain)">Go Tell It On the Mountain</a></h4>
HTML;

$tmp = new SongArticle("December Practice Schedule and Songs:", $article, '07/01/2019');
$expiry = $tmp->getExpiry();
$article = $tmp->getArticle();