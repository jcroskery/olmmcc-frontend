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
let table = document.getElementsByTagName('table')[0];
function onChange(event) {
    let element = event.target;
    let changeForm = new FormData();
    changeForm.append("name", element.name);
    changeForm.append("value", element.value);
    changeForm.append('id', element.parentElement.parentElement.id);
    changeForm.append('table', table.id);
    changeForm.append("session", window.localStorage.getItem("session"));
    sendReq(changeForm, "https://api.olmmcc.tk/change_row", onChangeComplete);
}
function onChangeComplete(json) {
    createNotification(json.message);
}
function onClickAdd() {
    let changeForm = new FormData();
    changeForm.append('table', table.id);
    let addInputs = document.getElementsByClassName('add');
    let names = [];
    let values = [];
    for (let i = 0; i < addInputs.length; i++) {
        names.push(addInputs[i].name);
        values.push(addInputs[i].value);
    }
    changeForm.append("names", JSON.stringify(names));
    changeForm.append("values", JSON.stringify(values));
    changeForm.append("session", window.localStorage.getItem("session"));
    sendReq(changeForm, "https://api.olmmcc.tk/add_row", displayAddedRow);
}
function displayAddedRow(json) {
    createNotification(json.message);
    if (json.success) {
        table.removeChild(document.getElementById('add')); //Remove old add row
        addRowToTable(json.row); //Create new row
        addAddRowToTable(); //Create new add row
    }
}
function onClickDelete(event) {
    let id = event.target.parentElement.parentElement.id;
    if (confirm('Are you sure you want to delete row ' + id + "?")) {
        let changeForm = new FormData();
        changeForm.append('id', id);
        changeForm.append('table', table.id);
        changeForm.append("session", window.localStorage.getItem("session"));
        sendReq(changeForm, "https://api.olmmcc.tk/delete_row", removeDeletedRow);
    }
}
function removeDeletedRow(json) {
    createNotification(json.message);
    if (json.success) {
        table.removeChild(document.getElementById(json.id)); //Remove deleted row
    }
}
function onClickMoveToStart(event) {
    let changeForm = new FormData();
    changeForm.append('id', event.target.parentElement.parentElement.id);
    changeForm.append('table', table.id);
    changeForm.append("session", window.localStorage.getItem("session"));
    sendReq(changeForm, "https://api.olmmcc.tk/move_row_to_start", moveRowToStart);
}
function moveRowToStart(json) {
    moveRow(json, 'start');
}
function moveRow(json, position) {
    createNotification(json.message);
    if (json.success) {
        table.removeChild(document.getElementById(json.old_id));
        addRowToTable(json.row, position);
    }
}
function onClickMoveToEnd(event) {
    let changeForm = new FormData();
    changeForm.append('id', event.target.parentElement.parentElement.id);
    changeForm.append('table', table.id);
    changeForm.append("session", window.localStorage.getItem("session"));
    sendReq(changeForm, "https://api.olmmcc.tk/move_row_to_end", moveRowToEnd);
}
function moveRowToEnd(json) {
    moveRow(json, 'secondlast');
}
function getOtherDatabaseTitles(json) {
    databaseTitles = [];
    databaseTitles[json.table] = json.titles;
    createTableHeader();
}
function getParsedColumns(json) {
    if (json.success == false) { //Not logged in as admin
        window.localStorage.setItem("notification", "Please log in to an administrator account to view this page.");
        window.location = '/login/';
        return;
    }
    parsedColumns = json.columns;
    parsedRows = json.rows;
    parsedTypes = json.types;
    for (let i = 0; i < parsedColumns.length; i++) {
        if (parsedColumns[i] === 'article') { //check for article (and other database dependencies)
            let changeForm = new FormData();
            changeForm.append('table', parsedColumns[i] + 's');
            changeForm.append("session", window.localStorage.getItem("session"));
            sendReq(changeForm, "https://api.olmmcc.tk/get_row_titles", getOtherDatabaseTitles);
            return;
        }
    }
    createTableHeader();
}
function createTableHeader() {
    let tableHeaderRow = document.createElement('tr');
    tableHeaderRow.id = 'tableHeaderRow';
    let tableHeader = '';
    parsedColumns.forEach(column => {
        if (column !== 'id') {
            tableHeader += ('<th>' + column + '</th>');
        }
    });
    tableHeader += "<th colspan='3'>Options</th>";
    tableHeaderRow.innerHTML = tableHeader;
    table.appendChild(tableHeaderRow);

    createRows();
}
function determineCellContents(type, name, value, add = false) {
    let td = document.createElement('td');
    if (type === 'date') {
        td.innerHTML = "<input type='date' name='" + name + "' value='" + value + "' />";
    } else if (type === 'text') {
        td.innerHTML = "<textarea name='" + name + "'>" + value + "</textarea>";
    } else if (name === 'article') {
        let tmpHtml = "<select name='" + name + "'>\
            <option value=''>None</option>"
        let otherTable = databaseTitles[name + 's']
        for (let i = 0; i < otherTable.length; i++) {
            tmpHtml += "<option>" + otherTable[i] + "</option>";
        }
        tmpHtml += "</select>";
        td.innerHTML = tmpHtml;
        let options = td.lastChild.childNodes;
        for (let i = 0; i < options.length; i++) {
            if (value === options[i].innerHTML) {
                options[i].setAttribute('selected', 'selected');
            }
        }
    } else {
        td.innerHTML = '<input type="text" name="' + name + '" value="' + value + '" />';
    }
    if (add) {
        td.lastChild.className = 'add';
    } else {
        td.lastChild.addEventListener('change', onChange);
    }
    return td;
}
function addRowToTable(rowData, position = 'end') {
    let tr = document.createElement('tr');
    let id_index = parsedColumns.indexOf("id");
    tr.id = rowData[id_index];
    for (let i = 0; i < rowData.length; i++) {
        if (i !== id_index) {
            tr.appendChild(determineCellContents(parsedTypes[i], parsedColumns[i], rowData[i]));
        }
    }

    let moveToStart = document.createElement('td'); //Options
    let moveToEnd = document.createElement('td');
    let deleteRow = document.createElement('td');
    deleteRow.className = moveToEnd.className = moveToStart.className = 'centerDiv';
    moveToStart.innerHTML = "<button name='start'>&#8593;</button>";
    moveToEnd.innerHTML = "<button name='end'>&#8595;</button>";
    deleteRow.innerHTML = "<button class='delete' name='delete'>Delete Row</button>";
    moveToStart.lastChild.addEventListener('click', onClickMoveToStart);
    moveToEnd.lastChild.addEventListener('click', onClickMoveToEnd);
    deleteRow.lastChild.addEventListener('click', onClickDelete);
    tr.appendChild(moveToStart);
    tr.appendChild(moveToEnd);
    tr.appendChild(deleteRow);
    if (position === 'start') {
        document.getElementById('tableHeaderRow').insertAdjacentElement('afterend', tr);
    } else if (position === 'secondlast') {
        document.getElementById('add').insertAdjacentElement('beforebegin', tr);
    } else {
        table.appendChild(tr);
    }
}
function addAddRowToTable() {
    let tr = document.createElement('tr');
    tr.id = 'add';
    for (let i = 0; i < parsedColumns.length; i++) {
        if (i !== parsedColumns.indexOf("id")) {
            tr.appendChild(determineCellContents(parsedTypes[i], parsedColumns[i], "New " + parsedColumns[i], true));
        }
    }

    let addRow = document.createElement('td');
    addRow.setAttribute('colspan', '3');
    addRow.className = 'centerDiv';
    addRow.innerHTML = "<button name='add'>Add Row</button>";
    addRow.addEventListener('click', onClickAdd);
    tr.appendChild(addRow);
    table.appendChild(tr);
}
function createRows() {
    for (i in parsedRows) {
        addRowToTable(parsedRows[i]);
    }
    addAddRowToTable();
}
{
    let changeForm = new FormData();
    changeForm.append('table', table.id);
    changeForm.append("session", window.localStorage.getItem("session"));
    sendReq(changeForm, "https://api.olmmcc.tk/get_database", getParsedColumns);
}
