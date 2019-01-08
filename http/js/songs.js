function closeVideo() {
    close();
}
let currentCode;
let displayed = false;
function displayPopupVideo(videocode) {
    displayed = true;
    removeGraydiv();
    display(videocode);
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
    close.onclick = closeVideo;
    document.getElementById("iframe-popup").appendChild(close);
}
function close() {
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
        close();
    }
}
document.onkeydown = keydown;
window.onresize = aFunction;
