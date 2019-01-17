<?php
include_once 'videohelper.php';
$adventcanon = youtube('https://www.youtube.com/embed/CVL429-caZ8');
$comethoulongexpectedjesus = youtube('https://www.youtube.com/embed/vRAFQCOkjgE');
$ohcomeohcomeemmanuel = youtube('https://www.youtube.com/embed/AlylvEkpJzw');
$daysofelijah = youtube('https://www.youtube.com/embed/ca9LnzJnpjQ');
$article = <<<HTML
<p>Our practices will be on Thursday, November 15th, 22th, and 29th. Below are the songs we will be singing at the Children's Mass on December 2nd:</p>
<h4>Processional: <a href="javascript:;" onclick="displayPopupVideo($adventcanon)">Advent Canon</a></h4>
<h4>Offertory: <a href="javascript:;" onclick="displayPopupVideo($comethoulongexpectedjesus)">Come Thou Long Expected Jesus</a></h4>
<h4>Communion: <a href="javascript:;" onclick="displayPopupVideo($ohcomeohcomeemmanuel)">Oh Come Oh Come Emmanuel</a></h4>
<h4>Recessional: <a href="javascript:;" onclick="displayPopupVideo($daysofelijah)">Days Of Elijah</a></h4>
HTML;

$tmp = new SongArticle("November Practice Schedule and Songs:", $article, '03/12/2018');
$expiry = $tmp->getExpiry();
$article = $tmp->getArticle();