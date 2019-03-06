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
require_once '/srv/http/helpers/displayMessage.php';
function add($table, $post)
{
    $columns = getAllColumns($table);
    $names = [];
    $contents = [];
    foreach ($columns as $column) {
        $columnName = $column['Field'];
        if ($column['Key'] != 'PRI') {
            $contents[] = sanitizeString($post[$columnName]);
            $names[] = $columnName;
        }
    }
    $result = createRow($table, $names, $contents);
    displayPopupNotification($result ? $result : "Successfully added!", '/admin/' . $table);
}
function change($table, $post)
{
    $id = sanitizeString($post['id']);
    foreach ($post as $key => $value) {
        if ($key != 'id') {
            $message .= changeRow($table, $id, $key, $value);
        }
    }
    displayPopupNotification($message != '' ? $message : 'Sucessfully updated song.', '/admin/' . $table);
}
function delete($table, $post)
{
    $result = deleteRow($table, $post['delete']);
    displayPopupNotification($message ? $message : "Deletion successful.", '/admin/' . $table);
}
