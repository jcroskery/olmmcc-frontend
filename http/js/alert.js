buttons = document.getElementsByClassName('delete');
for(i = 0; i < buttons.length; i++){
    buttons[i].onclick = function(){alert("To cancel deletion, close the browser window now!");};
}