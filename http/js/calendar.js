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
allLis = document.getElementsByTagName('li');
for(var i = 7; i < allLis.length; i++){
    allLis[i].onclick = onClick;  
}
const monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];
function loadJSON() {
    var xobj = new XMLHttpRequest();
    xobj.overrideMimeType("application/json");
    xobj.open("get", "/api/ajax/echoCalendarEvents.php", true);
    xobj.send();
    xobj.onload = onGetEvents;
}

function leftClick() {
    date.setMonth(date.getMonth() - 1);
    drawCalendar();
}
function rightClick() {
    date.setMonth(date.getMonth() + 1);
    drawCalendar();
}
function isCorrectDate(firstDate, secondDate) {
    return (firstDate.toDateString() == secondDate.toDateString());
}

eventsArray = [];
date = new Date();
caption = document.getElementsByTagName('h1')[0];
month = monthNames[date.getMonth()];
year = date.getFullYear();
firstDay = 0;
lastDay = 0;
caption.innerHTML = month + ' ' + year;

function drawCalendar() {
    month = monthNames[date.getMonth()];
    year = date.getFullYear()
    caption.innerHTML = month + ' ' + year;
    firstDay = new Date(date.getFullYear(), date.getMonth(), 1).getDay();
    lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
    for (let i = 1; i <= 42; i++) {

        let calendarDate = i - firstDay;
        var currentDate = new Date(date.getFullYear(), date.getMonth(), calendarDate);
        if (calendarDate == date.getDate()) {
            document.getElementById(i).className = 'selectedDate';
        } else {
            document.getElementById(i).className = '';
        }
        if (calendarDate > 0 && calendarDate <= lastDay) {
            document.getElementById(i).innerHTML = calendarDate;
            eventsArray.forEach(event => {
                if (isCorrectDate(currentDate, event['date'])) {
                    document.getElementById(i).innerHTML += ('<p class="calendarEventTitle">' + event['title'] + '</p>' + '<p class="calendarEvent">' + event['time'] + '</p>');
                }
            });
            if (i == 36) { //If sixth week is needed
                document.getElementsByClassName("bodyUl")[5].classList = "bodyUl";
            }
        } else {
            document.getElementById(i).innerHTML = '';
            if (i == 36) { //If sixth week is unneeded
                document.getElementsByClassName("bodyUl")[5].classList += ' hide';
            }
        }

    }
}
function keydown(event) {
    switch(event.keyCode) {
        case 27:
            clearDetails();
            return;
        case 37:
            date = new Date(date.getFullYear(), date.getMonth(), date.getDate() - 1);
            break;
        case 39:
            date = new Date(date.getFullYear(), date.getMonth(), date.getDate() + 1);
            break;
        case 38:
            date = new Date(date.getFullYear(), date.getMonth(), date.getDate() - 7);
            break;
        case 40:
            date = new Date(date.getFullYear(), date.getMonth(), date.getDate() + 7);
    }
    drawCalendar();
}
function clearDetails() {
    var element = document.getElementById("graydiv");
    if (element != null) {
        element.parentNode.removeChild(element);
    }
}
function displayDetails(clickedId) {
    clearDetails();
    let grayDiv = document.createElement('div');
    grayDiv.id = 'graydiv';
    document.getElementById('myPage').append(grayDiv);
    let detailsDiv = document.createElement('div');
    detailsDiv.id = 'detailsDiv';

    eventsArray.forEach(event => {
        if (isCorrectDate(date, event['date'])) {
            detailsDiv.innerHTML = '<h4>' + event['title'] + '</h4>';
            detailsDiv.innerHTML += '<p>Time: ' + event['time'] + '</p>';
            detailsDiv.innerHTML += '<p>Notes: ' + event['notes'] + '</p>';
        }
    });
    document.getElementById('graydiv').append(detailsDiv);
    let close = getCloseButton('closeDetails');
    document.getElementById("detailsDiv").innerHTML += close;
    document.getElementById('closeDetails').onclick = clearDetails;
}
function onClick() {
    date = new Date(date.getFullYear(), date.getMonth(), this.id - firstDay);
    if (document.getElementById(this.id).innerHTML.includes('<p ')) {
        displayDetails(date);
    }
    drawCalendar();
}
function timeFormatter(time){
    var hours = Number(time.substr(0, 2));
    return ((hours > 12) ? hours - 12 : hours) + time.slice(2, -3) + ((hours < 12) ? " AM" : " PM")
}
function onGetEvents() {
    response = this.responseText;
    actual_JSON = JSON.parse(response);
    for (var i = 0; i < actual_JSON.length; i++) {
        obj = actual_JSON[i];
        eventsArray.push({
            date : new Date(obj.date + "T12:00:00"), 
            title : obj.title, 
            time : timeFormatter(obj.startTime) + ' to ' + timeFormatter(obj.endTime), 
            notes : obj.notes
        });
    }
    drawCalendar();
    document.getElementsByClassName('leftButton')[0].onclick = leftClick;
    document.getElementsByClassName('rightButton')[0].onclick = rightClick;
    document.onkeydown = keydown;
}; 
loadJSON();