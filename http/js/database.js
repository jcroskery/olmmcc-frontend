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
    changeForm.append(element.name, element.value);
    changeForm.append('id', element.parentElement.parentElement.id);
    changeForm.append('table', table.id);
    let xobj = new XMLHttpRequest();
    xobj.overrideMimeType("application/json");
    xobj.addEventListener("load", onSubmitForm);
    xobj.open("POST", "/api/database/change.php", true);
    xobj.send(changeForm);
}
function onSubmitForm() {
    createNotification(this.responseText);
}
function onClickAdd() {
    let changeForm = new FormData();
    changeForm.append('table', table.id);
    let addInputs = document.getElementsByClassName('add');
    for(let i = 0; i < addInputs.length; i++) {
        changeForm.append(addInputs[i].name, addInputs[i].value);
    }
    let xobj = new XMLHttpRequest();
    xobj.overrideMimeType("application/json");
    xobj.addEventListener("load", displayAddedRow);
    xobj.open("POST", "/api/database/add.php", true);
    xobj.send(changeForm);
}
function displayAddedRow() {
    let parsedResponse = JSON.parse(this.responseText);
    createNotification(parsedResponse.message);
    if(parsedResponse.success) {
        table.removeChild(document.getElementById('add')); //Remove old add row
        addRowToTable(parsedResponse.row); //Create new row
        addAddRowToTable(); //Create new add row
    }
}
function onClickDelete(event) {
    let id = event.target.parentElement.parentElement.id;
    if (confirm('Are you sure you want to delete row ' + id + "?")) {
        let changeForm = new FormData();
        changeForm.append('id', id);
        changeForm.append('table', table.id);
        let xobj = new XMLHttpRequest();
        xobj.overrideMimeType("application/json");
        xobj.addEventListener("load", removeDeletedRow);
        xobj.open("POST", "/api/database/delete.php", true);
        xobj.send(changeForm);
    }
}
function removeDeletedRow() {
    let parsedResponse = JSON.parse(this.responseText);
    createNotification(parsedResponse.message);
    if (parsedResponse.success) {
        table.removeChild(document.getElementById(parsedResponse.id)); //Remove deleted row
    }
}
function onClickMoveToStart(event) {
    let changeForm = new FormData();
    changeForm.append('id', event.target.parentElement.parentElement.id);
    changeForm.append('table', table.id);
    let xobj = new XMLHttpRequest();
    xobj.overrideMimeType("application/json");
    xobj.addEventListener("load", onSubmitForm);
    xobj.open("POST", "/api/database/start.php", true);
    xobj.send(changeForm);
}
function onClickMoveToEnd(event) {
    let changeForm = new FormData();
    changeForm.append('id', event.target.parentElement.parentElement.id);
    changeForm.append('table', table.id);
    submitXHR(changeForm, "/api/database/end.php", onSubmitForm);
}
function submitXHR(changeForm, url, onLoad) {
    let xobj = new XMLHttpRequest();
    xobj.overrideMimeType("application/json");
    xobj.addEventListener("load", onLoad);
    xobj.open("POST", url, true);
    xobj.send(changeForm);
}
function createTableHeader() {
    let tableHeaderRow = document.createElement('tr');
    parsedColumns = JSON.parse(this.responseText);
    let tableHeader = '';
    for (let name in parsedColumns) {
        if(name !== 'id') {
            tableHeader += ('<th>' + name + '</th>');
        }
    }
    tableHeader += "<th colspan='3'>Options</th>";
    tableHeaderRow.innerHTML = tableHeader;
    table.appendChild(tableHeaderRow);

    let changeForm = new FormData();
    changeForm.append('table', table.id);
    changeForm.append('request', 'getAllRows');
    submitXHR(changeForm, "/api/database/accessTableJs.php", createRows);
}
function determineCellContents(type, name, value, add = false) {
    let td = document.createElement('td');
    if (type === 'date') {
        td.innerHTML = "<input type='date' name='" + name + "' value='" + value + "' />";
    } else if (type === 'text') {
        td.innerHTML = "<textarea name='" + name + "'>" + value + "</textarea>";
    } else {
        td.innerHTML = '<input type="text" name="' + name + '" value="' + value + '" />';
    }
    if(add) {
        td.lastChild.className = 'add';
    } else {
        td.lastChild.addEventListener('change', onChange);
    }
    return td;
}
function addRowToTable(rowData) {
    let tr = document.createElement('tr');
    tr.id = rowData['id'];
    for (name in rowData) {
        if (name !== 'id') {
            tr.appendChild(determineCellContents(parsedColumns[name], name, rowData[name]));
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
    table.appendChild(tr);
}
function addAddRowToTable() {
    let tr = document.createElement('tr');
    tr.id = 'add';
    for (name in parsedColumns) {
        if (name !== 'id') {
            tr.appendChild(determineCellContents(parsedColumns[name], name, "New " + name, true));
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
    let parsedRows = JSON.parse(this.responseText);
    for(i in parsedRows) {
        addRowToTable(parsedRows[i]);
    }
    addAddRowToTable();
}
{
    let changeForm = new FormData();
    changeForm.append('table', table.id);
    changeForm.append('request', 'getColumnTitles');
    submitXHR(changeForm, "/api/database/accessTableJs.php", createTableHeader);
}
