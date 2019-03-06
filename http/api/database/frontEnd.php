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
function getTableContents($table, $name)
{
    $rows = getAllRows($table);
    $columns = getAllColumns($table);
    $tableContents = '';
    foreach ($rows as $row) {
        $rowContents = '';
        foreach ($columns as $column) {
            $columnName = $column['Field'];
            if ($column['Key'] != 'PRI') {
                $rowContents .= "<td><input name='" . $columnName . "' value='" . $row[$columnName] ."'/></td>";
            }
        }
        $id = $row['id'];
        $tableContents .= <<<HTML
        <tr>
            <form action='change/' method='post'>
                $rowContents
                <td><button type='submit' name='id' value='$id'>Save Changes</button></td>
            </form>
            <td>
                <form action='delete/' method='post'>
                    <button class='delete' name=$id value='delete'>Delete $name</button>
                </form>
            </td>
        <tr>
HTML;
    }
    return $tableContents;
}
function outputTable($title, $table, $name)
{
    $tableContents = getTableContents($table, $name);
    $columns = getAllColumns($table);
    $tableHeader = '';
    $addRow = '';
    foreach ($columns as $column) {
        $columnName = $column['Field'];
        if ($column['Key'] != 'PRI') {
            $tableHeader .= '<th>' . ucfirst($columnName) . '</th>';
            $addRow .= '<td><input name="' . $columnName . '" value="New ' . ucfirst($columnName) . '"/></td>';
        }
    }
    echo <<<HTML
        <table class='database'>
            <caption>$title</caption>
        <tr>
            $tableHeader
            <th colspan='2'>Options</th>
        </tr>
        $tableContents
        <tr>
            <form action='add/' method='post'>
                $addRow
                <td colspan='2' class='centerDiv'><button type='submit' name='add'>Add $name</button></td>
            </form>
        </tr>
        </table>
HTML;
}
