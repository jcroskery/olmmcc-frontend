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
require_once '/srv/http/api/database/accessTable.php';
function addSong($name, $link, $notes){
    createRow('songs', ['name', 'link', 'notes'], [$name, $link, $notes]);
}
function changeName($name, $id){
    changeRow('songs', $id, 'name', $name);
}
function changeLink($link, $id){
    changeRow('songs', $id, 'link', $link);
}
function changeNotes($notes, $id){
    changeRow('songs', $id, 'notes', $notes);
}
function deleteSong($id)
{
    deleteRow('songs', $id);
}
function getSong($name){
    return getRow('songs', 'name', $name);
}
function getSongs(){
    return getAllRows('songs');
}