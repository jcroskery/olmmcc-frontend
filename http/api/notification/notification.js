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
function createNotification(notificationText) { //This is needed for ajax notifications, otherwise the code would only be in wrapper.php
    closeNotification(); //Let's close other notifications first
    let notificationDiv = document.createElement("div");
    notificationDiv.id = 'notificationDiv';
    notificationDiv.innerHTML = "\
        <p id='notificationP'>" + notificationText + "</p>\
        <svg id='closeNotification' viewBox='0, 0, 100, 100'>\
            <circle cx=50 cy=50 r=50 fill=black />\
            <rect class='whiteRect' y='55' rx=13 ry=13 x='-45' transform='rotate(-45 0 0)' width='90' height='25' />\
            <rect class='whiteRect' y='-15' rx=13 ry=13 x='25' transform='rotate(45 0 0)' width='90' height='25' />\
        </svg>";
    document.getElementById('myPage').appendChild(notificationDiv);
    document.getElementById('closeNotification').addEventListener('click', closeNotification);
}
function closeNotification() {
    var element = document.getElementById("notificationDiv");
    if (element != null) {
        element.parentNode.removeChild(element);
    }
}
function keydown(event) {
    if (event.keyCode == 27) {
        closeNotification();
    }
}
document.addEventListener('keydown', keydown);
closeButton = document.getElementById('closeNotification');
if (closeButton) {
    closeButton.addEventListener('click', closeNotification);
}