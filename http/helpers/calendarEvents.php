<?php
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