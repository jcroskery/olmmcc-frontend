<?php
include_once 'videohelper.php';
$opening = createVideo('Come, Now Is the Time to Worship','Opening','https://www.youtube.com/embed/hErw7RrI9Ak?start=45');
$offertory = createVideo('The Same Love','Offertory','https://www.youtube.com/embed/yVSv0ewppY4');
$communion = createVideo('Reign In Us','Communion','https://www.youtube.com/embed/_dohj2QAdzs');
$closing = createVideo('You Will Never Run','Closing','https://www.youtube.com/embed/ONYUM3v35S4');
$article = <<<HTML

<p>Our practices this month will be on Thursday, January 17th and Thursday, January 31rd. Below are the songs we will be singing at the Children's Mass on February 3rd:</p>

$opening
$offertory
$communion
$closing
HTML;

$tmp = new BasicArticle("January Practice Schedule and Songs:", $article, '04/02/2019');
$expiry = $tmp->getExpiry();
$article = $tmp->getArticle();