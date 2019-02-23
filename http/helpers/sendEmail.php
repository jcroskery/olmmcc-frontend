<?php
/*
Copyright (C) 2019  Justus Croskery
To contact me, email me at justus@olmmcc.tk.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see https://www.gnu.org/licenses/.
*/
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