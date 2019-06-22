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
include_once '/srv/http/helpers/wrapper.php';
function determineCellContents($column, $columnName, $currentValue, $class = '')
{
    if ($column["Type"] == 'date') {
        return <<<HTML
        <td>
            <input type="date" name="$columnName" class='$class' value="$currentValue"/>
        </td>
HTML;
    }
    if ($column["Type"] == 'text') {
        return <<<HTML
        <td>
            <textarea name="$columnName" class='$class'>$currentValue</textarea>
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
            <select name="$columnName" class='$class'>
                <option disabled selected='selected'>$currentValue</option>
                $options
                $noneOption
            </select>
        </td>
HTML;
    }
    return <<<HTML
    <td>
        <input type="text" name="$columnName" value="$currentValue" class='$class'/>
    </td>
HTML;

}
function getTableContents($table, $name)
{
    $columns = getAllColumns($table);
    foreach (getAllRows($table) as $row) {
        $rowContents = '';
        $id = $row['id'];
        foreach ($columns as $column) {
            $columnName = $column['Field'];
            if ($column['Key'] != 'PRI') {
                $currentValue = ($row[$columnName]) ? $row[$columnName] : 'None';
                $rowContents .= determineCellContents($column, $columnName, $currentValue, "onChange");
            }
        }
        $tableContents .= <<<HTML
        <tr id=$id>
            $rowContents
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
                <button class='delete' name=$table value=$id>Delete $name</button>
            </td>
        <tr>
HTML;
    }
    return $tableContents;
}
function outputTable($title, $table, $name)
{
    wrapperBegin($title, 'databaseClass');
    foreach (getAllColumns($table) as $column) {
        $columnName = $column['Field'];
        $formattedColumnName = ucfirst(preg_replace('/(?<!\ )[A-Z]/', ' $0', $columnName));
        if ($column['Key'] != 'PRI') {
            $tableHeader .= '<th>' . $formattedColumnName . '</th>';
            $defaultValue = 'New ' . $formattedColumnName;
            $addRow .= determineCellContents($column, $columnName, $defaultValue, 'add');
        }
    }
    $tableContents = getTableContents($table, $name);
    echo <<<HTML
        <table class='database' id='$table'>
            <caption>$title</caption>
        <tr>
            $tableHeader
            <th colspan='3'>Options</th>
        </tr>
        $tableContents
        <tr>
            $addRow
            <td colspan='3' class='centerDiv'>
                <button id='addSubmit' name=$table>Add $name</button>
            </td>
        </tr>
        </table>
HTML;
    wrapperEnd('account', '<script src="/api/notification/createNotification.js"></script><script src="/api/notification/closeNotification.js"></script><script src="/js/databaseAjax.js"></script>', false);
}