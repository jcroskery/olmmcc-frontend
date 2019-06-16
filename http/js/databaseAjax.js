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
    changeForm = new FormData();
    changeForm.append(element.name, element.value);
    console.log(element)
    changeForm.append('id', element.parentNode.id);
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
let fields = document.getElementsByClassName('onChange');
for(let i = 0; i < fields.length; i++) {
    fields[i].addEventListener('change', onChange);
}