<?php
    
    function sanitizeString($var)
    {
        if(get_magic_quotes_gpc){
            $var = stripslashes($var);
        }
        $var = strip_tags($var);
        $var = htmlentities($var);
        return $var;
    }
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) {
        die("Connection error");
    }
    