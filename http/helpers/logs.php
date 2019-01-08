<?php
function basicLog($filepath, $info){
    $myfile = fopen("/srv/http/logs/" . $filepath, "a") or die("Unable to open file!");
    fwrite($myfile, $_SERVER['CF-Connecting-IP'] . $info);
    fclose($myfile);
}