<?php
include_once 'videohelper.php';
$opening = createVideo('Come, Now Is the Time to Worship','Opening','https://www.youtube.com/embed/hErw7RrI9Ak?start=45');
$offertory = createVideo('The Same Love','Offertory','https://www.youtube.com/embed/yVSv0ewppY4');
$communion = createVideo('Reign In Us','Communion','https://www.youtube.com/embed/_dohj2QAdzs');
$closing = createVideo('You Will Never Run','Closing','https://www.youtube.com/embed/ONYUM3v35S4');
$article = <<<HTML

$opening
$offertory
$communion
$closing
HTML;
