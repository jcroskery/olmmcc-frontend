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
function loadImageList() {
    var xobj = new XMLHttpRequest();
    xobj.overrideMimeType("application/json");
    xobj.open("get", "https://api.olmmcc.tk/get_image_list", true);
    xobj.send();
    xobj.onload = onLoadImageList;
}
function onLoadImageList() {
    var response = this.responseText;
    imageList = JSON.parse(response)["images"];
    currentImage = 0;
    displayImage(imageList[currentImage]);
    document.onkeydown = keydown;
    document.getElementsByClassName('leftButton')[0].onclick = leftClick;
    document.getElementsByClassName('rightButton')[0].onclick = rightClick;
}
function keydown(event) {
    switch (event.keyCode) {
        case 37:
            leftClick();
            break;
        case 39:
            rightClick();
            break;
    }
}
function displayImage(imageUrl) {
    var imageBackgroundDiv = document.getElementById('imageBackgroundDiv');
    imageBackgroundDiv.style.backgroundImage = "url('/images/" + imageUrl + "')";
}
function offsetCurrentImage(offset) {
    currentImage += offset;
    if(currentImage < 0) {currentImage += imageList.length;}
    if(currentImage >= imageList.length) { currentImage %= imageList.length;}
    return currentImage;
}
function leftClick() {
    displayImage(imageList[offsetCurrentImage(-1)]);
}
function rightClick(){
    displayImage(imageList[offsetCurrentImage(1)]);
}
loadImageList();
