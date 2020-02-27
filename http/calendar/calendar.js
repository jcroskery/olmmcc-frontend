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
const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
const days = ['Sun.', 'Mon.', 'Tues.', 'Wed.', 'Thurs.', 'Fri.', 'Sat.'];
allLis = document.getElementsByTagName('li');
for (var i = 7; i < allLis.length; i++) {
    allLis[i].addEventListener("click", onClick);
}
date = new Date();
caption = document.getElementsByTagName('h1')[0];
eventsArray = [];

function loadJSON() {
    sendReq({ "year_month": currentYearMonthString }, "https://api.olmmcc.tk/get_calendar_events", onGetEvents);
}
function previousMonth() {
    setSelectedDate(date.getFullYear(), date.getMonth() - 1, 1);
}
function nextMonth() {
    setSelectedDate(date.getFullYear(), date.getMonth() + 1, 1);
}
function isCorrectDate(firstDate, secondDate) {
    return (firstDate.toDateString() == secondDate.toDateString());
}
function getFormattedYearMonthString(year, month) {
    return year + "-" + (++month > 9 ? month : "0" + month) + "%";
}
function setSelectedDate(year, month, day, forcedRefresh = false) {
    let newDate = new Date(year, month, day);
    if (!forcedRefresh && newDate.getMonth() === date.getMonth()) {
        document.getElementById(date.getDate() + firstDay).className = '';
        document.getElementById(newDate.getDate() + firstDay).className = 'selectedDate';
        date = newDate;
    } else {
        date = newDate;
        currentYearMonthString = getFormattedYearMonthString(date.getFullYear(), date.getMonth());
        if (eventsArray[currentYearMonthString] !== undefined) { //We already have the events
            drawCalendar();
        } else {
            loadJSON();
        }
    }
}
function drawCalendar() {
    caption.innerHTML = monthNames[date.getMonth()] + ' ' + date.getFullYear();
    firstDay = new Date(date.getFullYear(), date.getMonth(), 1).getDay();
    let lastDate = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
    let hide = document.getElementsByClassName("hide")[0] //Reset the sixth week
    if (hide) {
        hide.className = "bodyUl"; //Unhide the sixth week
    }
    for (let i = 1; i <= 42; i++) {
        let currentElement = document.getElementById(i);
        currentElement.className = '';
        let calendarDate = i - firstDay;
        var currentDate = new Date(date.getFullYear(), date.getMonth(), calendarDate);
        if (calendarDate == date.getDate()) {
            currentElement.className = 'selectedDate';
        }
        if (calendarDate > 0 && calendarDate <= lastDate) {
            currentElement.innerHTML = "<span class='weekday'>" + days[currentDate.getDay()]
                + " </span>" + calendarDate;
            eventsArray[getFormattedYearMonthString(date.getFullYear(), date.getMonth())].forEach
                (event => {
                    if (isCorrectDate(currentDate, event['date'])) {
                        currentElement.innerHTML += ('<p class="calendarEventTitle">' +
                            event['title'] + '</p>' + '<p class="calendarEvent">' + event['time']
                            + '</p>');
                    }
                });
        } else {
            currentElement.className = 'unNeededDate';
            currentElement.innerHTML = '';
            if (i == 36) { //If sixth week is unneeded
                document.getElementsByClassName("bodyUl")[5].className = 'hide';
            }
        }
    }
}
function monthViewKeydown(event) {
    switch (event.keyCode) {
        case 27:
            return clearDetails();
        case 37:
            return setSelectedDate(date.getFullYear(), date.getMonth(), date.getDate() - 1);
        case 39:
            return setSelectedDate(date.getFullYear(), date.getMonth(), date.getDate() + 1);
        case 38:
            return setSelectedDate(date.getFullYear(), date.getMonth(), date.getDate() - 7);
        case 40:
            return setSelectedDate(date.getFullYear(), date.getMonth(), date.getDate() + 7);
    }
}
function weekViewKeydown(event) {
    switch (event.keyCode) {
        case 27:
            return clearDetails();
        case 37:
            return previousMonth();
        case 39:
            return nextMonth();
        case 38:
            return setSelectedDate(date.getFullYear(), date.getMonth(), date.getDate() - 1);
        case 40:
            return setSelectedDate(date.getFullYear(), date.getMonth(), date.getDate() + 1);
    }
}
function clearDetails() {
    var element = document.getElementById("graydiv");
    if (element) {
        element.parentNode.removeChild(element);
    }
}
function displayDetails() {
    clearDetails();
    let grayDiv = document.createElement('div');
    grayDiv.id = 'graydiv';
    document.getElementById('myPage').append(grayDiv);
    let detailsDiv = document.createElement('div');
    detailsDiv.id = 'detailsDiv';
    eventsArray[getFormattedYearMonthString(date.getFullYear(), date.getMonth())].forEach
        (event => {
            if (isCorrectDate(date, event['date'])) {
                detailsDiv.innerHTML = '<h4>' + event['title'] + '</h4><p>Time: ' +
                    event['time'] + '</p><p>Notes: ' + event['notes'] + '</p>';
            }
        });
    document.getElementById('graydiv').append(detailsDiv);
    let close = getCloseButton('closeDetails');
    document.getElementById("detailsDiv").innerHTML += close;
    document.getElementById('closeDetails').onclick = clearDetails;
}
function onClick() {
    setSelectedDate(date.getFullYear(), date.getMonth(), this.id - firstDay);
    if (document.getElementById(this.id).innerHTML.includes('<p ')) {
        displayDetails();
    }
}
function timeFormatter(time) {
    var hours = Number(time.substr(0, 2));
    return ((hours > 12) ? hours - 12 : hours) + time.slice(2, -3) + ((hours < 12) ? " AM" : " PM")
}
function onResize() {
    if (window.outerWidth > 739) {
        document.addEventListener('keydown', monthViewKeydown);
    } else {
        document.addEventListener('keydown', weekViewKeydown);
    }
}
function onGetEvents(json) {
    eventsArray[currentYearMonthString] = [];
    for (var i = 0; i < json.length; i++) {
        obj = json[i];
        eventsArray[currentYearMonthString].push({
            date: new Date(obj.date + "T12:00:00"),
            title: obj.title,
            time: timeFormatter(obj.start_time) + ' to ' + timeFormatter(obj.end_time),
            notes: obj.notes
        });
    }
    drawCalendar();
};
document.getElementsByClassName('leftButton')[0].onclick = previousMonth;
document.getElementsByClassName('rightButton')[0].onclick = nextMonth;
window.addEventListener("resize", onResize, false); //For switching between month and week key bindings
onResize(); //Set initial key bindings
setSelectedDate(date.getFullYear(), date.getMonth(), date.getDate(), true);
