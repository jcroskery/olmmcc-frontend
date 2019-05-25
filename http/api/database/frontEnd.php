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
function determineCellContents($column, $columnName, $currentValue)
{
    if ($column["Type"] == 'date') {
        return <<<HTML
        <td>
            <input type="date" name="$columnName" value="$currentValue"/>
        </td>
HTML;
    }
    if ($column["Type"] == 'text') {
        return <<<HTML
        <td>
            <textarea name="$columnName">$currentValue</textarea>
        </td>
HTML;
    }
    $type = false;
    foreach (getTables() as $tableName) {
        if ($columnName . 's' === $tableName) {$type = $tableName;}
    }
    if ($type) {
        $options = '';
        foreach (getAllRows($type) as $tableRow) {
            if ($currentValue !== $tableRow['title']) {
                $options .= '<option ' . ' value="' . $tableRow['title'] . '">' . $tableRow['title'] . '</option>';
            }
        }
        $noneOption = ($currentValue !== 'None') ? "<option value=''>None</option>" : '';
        return <<<HTML
        <td>
            <select name="$columnName">
                <option disabled selected='selected'>$currentValue</option>
                $options
                $noneOption
            </select>
        </td>
HTML;
    }
    return <<<HTML
    <td>
        <input type="text" name="$columnName" value="$currentValue"/>
    </td>
HTML;

}
function getTableContents($table, $name)
{
    $columns = getAllColumns($table);
    foreach (getAllRows($table) as $row) {
        $rowContents = '';
        foreach ($columns as $column) {
            $columnName = $column['Field'];
            if ($column['Key'] != 'PRI') {
                $currentValue = ($row[$columnName]) ? $row[$columnName] : 'None';
                $rowContents .= determineCellContents($column, $columnName, $currentValue);
            }
        }
        $id = $row['id'];
        $tableContents .= <<<HTML
        <tr>
            <form action='/api/database/change.php' method='post'>
                $rowContents
                <td class='centerDiv'>
                    <button type='submit' name=$table value='$id'>Save Changes</button>
                </td>
            </form>
            <td class='centerDiv'>
                <form action='/api/database/start.php' class='inline' method='post'>
                    <button name=$table value=$id>&#8593;</button>
                </form>
            </td>
            <td class='centerDiv'>
                <form action='/api/database/end.php' class='inline' method='post'>
                    <button name=$table value=$id>&#8595;</button>
                </form>
            </td>
            <td class='centerDiv'>
                <form action='/api/database/delete.php' method='post'>
                    <button class='delete' name=$table value=$id>Delete $name</button>
                </form>
            </td>
        <tr>
HTML;
    }
    return $tableContents;
}
function outputTable($title, $table, $name)
{
    
    foreach (getAllColumns($table) as $column) {
        $columnName = $column['Field'];
        $formattedColumnName = ucfirst(preg_replace('/(?<!\ )[A-Z]/', ' $0', $columnName));
        if ($column['Key'] != 'PRI') {
            $tableHeader .= '<th>' . $formattedColumnName . '</th>';
            $defaultValue = 'New ' . $formattedColumnName;
            $addRow .= determineCellContents($column, $columnName, $defaultValue);
        }
    }
    $tableContents = getTableContents($table, $name);
    echo <<<HTML
        <table class='database'>
            <caption>$title</caption>
        <tr>
            $tableHeader
            <th colspan='4'>Options</th>
        </tr>
        $tableContents
        <tr>
            <form action='/api/database/add.php' method='post'>
                $addRow
                <td colspan='4' class='centerDiv'>
                    <button type='submit' name=$table>Add $name</button>
                </td>
            </form>
        </tr>
        </table>
HTML;
}