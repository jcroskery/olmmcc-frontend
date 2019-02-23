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
links = document.getElementsByClassName('songLink');
for (i = 0; i < links.length; i++) {
    links[i].onclick = displayPopupVideo;
}
let currentCode;
let displayed = false;
function displayPopupVideo() {
    displayed = true;
    removeGraydiv();
    display(this.id);
}
function removeGraydiv() {
    var element = document.getElementById("graydiv");
    if (element != null) {
        element.parentNode.removeChild(element);
    }

}
function display(videocode) {
    currentCode = videocode;
    let graydiv = document.createElement("div");
    graydiv.id = 'graydiv';
    document.getElementById("myPage").appendChild(graydiv);
    graydiv.innerHTML = videocode;
    let close = document.createElement('img');
    close.src = '../images/close.gif';
    close.id = 'closeVideo';
    close.onclick = closeDiv;
    document.getElementById("iframe-popup").appendChild(close);
}
function closeDiv() {
    displayed = false;
    removeGraydiv();
}
function onResize() {
    if (!window.innerHeight == screen.height) {
        if (displayed) {
            displayPopupVideo(currentCode);
        }
    }

}

function aFunction() {
    clearTimeout(resizeId);
    resizeId = setTimeout(onResize, 50);
}
function keydown(event) {
    if (event.keyCode == 27) {
        closeDiv();
    }
}
document.onkeydown = keydown;
window.onresize = aFunction;
