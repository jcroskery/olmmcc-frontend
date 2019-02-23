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
function openJSON(){
    return json_decode(file_get_contents('/srv/http/json/calendar/calendarEvents.json'), true);
}
function getJSON($id = 0){
    if($id){
        $returnValue = openJSON()[$id];
        if($returnValue != ''){
            return $returnValue;
        }
        return false;
    } else {
        return openJSON();
    }
}
function modifyObject($id, $params){
    $json = openJSON();
    $object = $json[$id];
    foreach($object as $jsonKey => $jsonValue){
        foreach($params as $modifyKey => $modifyValue){
            if($jsonKey==$modifyKey){
                $object[$jsonKey] = $modifyValue;
            }
        }
    }
    $json[$id] = $object;
    saveJSON($json);
}
function deleteObject($id){
    $json = openJSON();
    unset($json[$id]);
    saveJSON($json);
}
function createObject($object){
    $id = generateId();
    $json = openJSON();
    $json[$id] = $object;
    saveJSON($json);
    return $id;
}
function generateId(){
    $id = 1;
    while(true){
        if(!getJSON($id)){
            return $id;
        }
        $id++;
    }
}
function saveJSON($jsonToSave){
    $jsonFile = fopen('/srv/http/json/calendar/calendarEvents.json', 'w');
    fwrite($jsonFile, json_encode($jsonToSave));
    fclose($jsonFile);
}