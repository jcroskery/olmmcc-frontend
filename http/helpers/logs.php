<?php
function basicLog($filepath, $info){
    $myfile = fopen("/srv/http/logs/" . $filepath, "a") or die("Unable to open file!");
    fwrite($myfile, date('d/m/Y', time()) . $info);
    fclose($myfile);
}