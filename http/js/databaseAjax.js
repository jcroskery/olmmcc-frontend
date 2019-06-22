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
function onChange(event) {
    let element = event.target;
    let changeForm = new FormData();
    changeForm.append(element.name, element.value);
    changeForm.append('id', element.parentElement.parentElement.id);
    changeForm.append('table', document.getElementsByTagName('table')[0].id);
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
    changeForm.append('table', document.getElementsByTagName('table')[0].id);
    let addInputs = document.getElementsByClassName('add');
    for(let i = 0; i < addInputs.length; i++) {
        changeForm.append(addInputs[i].name, addInputs[i].value);
    }
    let xobj = new XMLHttpRequest();
    xobj.overrideMimeType("application/json");
    xobj.addEventListener("load", onSubmitForm);
    xobj.open("POST", "/api/database/add.php", true);
    xobj.send(changeForm);
}
function onClickDelete(event) {
    let id = event.target.parentElement.parentElement.id;
    if (confirm('Are you sure you want to delete row ' + id + "?")) {
        let changeForm = new FormData();
        changeForm.append('id', id);
        changeForm.append('table', document.getElementsByTagName('table')[0].id);
        let xobj = new XMLHttpRequest();
        xobj.overrideMimeType("application/json");
        xobj.addEventListener("load", onSubmitForm);
        xobj.open("POST", "/api/database/delete.php", true);
        xobj.send(changeForm);
    }
}
let fields = document.getElementsByClassName('onChange');
for(let i = 0; i < fields.length; i++) {
    fields[i].addEventListener('change', onChange);
}
let deleteButtons = document.getElementsByClassName('delete');
for (let i = 0; i < deleteButtons.length; i++) {
    deleteButtons[i].addEventListener('click', onClickDelete);
}
document.getElementById('addSubmit').addEventListener('click', onClickAdd);
