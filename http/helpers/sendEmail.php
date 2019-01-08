<?php
function sendEmail($subject, $message, $username, $email)
{
    $fp = fopen('/srv/http/json/outgoing/' . $subject . $username . '.json', 'w');
    $object = new stdClass();
    $object->message = $message . '<p>(This message was automatically sent by the OLMMCC website. If this message was received in error please notify justus@olmmcc.tk immediately.)</p>';
    $object->subject = $subject;
    $object->username = $username;
    $object->email = $email;
    $object->time = time();
    fwrite($fp, json_encode($object));
    fclose($fp);
}
function getEmail($subject, $message, $username, $email){
    $fp = fopen('/srv/http/json/incoming/' . $subject . $username . '.json', 'w');
    $object = new stdClass();
    $object->message = $message;
    $object->subject = $subject;
    $object->username = $username;
    $object->email = $email;
    $object->time = time();
    fwrite($fp, json_encode($object));
    fclose($fp);
}