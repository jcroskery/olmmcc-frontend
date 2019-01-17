<?php
require_once '/srv/logincreds.php';
function addSong($name, $link){
    global $connection;
    $stmt = $connection->prepare("INSERT INTO songs (name, link) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $link);
    $stmt->execute();
}
function changeName($id, $name){
    
}