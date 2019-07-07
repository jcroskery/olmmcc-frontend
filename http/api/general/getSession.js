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
function handleSession() {
    parsedResponse = JSON.parse(this.responseText);
    if(parsedResponse.session === 'active') {
        if(parsedResponse.username !== '') {
            let signup = document.querySelectorAll("a[href='/signup']")[1]; //only the second one needs to be changed
            signup.href = '/logout';
            signup.textContent = "Logout";
            signup.id = '';
            let logins = document.querySelectorAll("a[href='/login']");
            for(let i = 0; i < logins.length; i++) {
                let active = document.getElementById('active');
                if (active && active.href.includes('/account/')) {
                    active.textContent = "Welcome, " + parsedResponse.username;
                    logins[i].id = 'active';
                }
                logins[i].href = '/account/';
                logins[i].textContent = "Welcome, " + parsedResponse.username;
            }
        }
        if(parsedResponse.notification !== '') {
            let script = document.createElement('script');
            script.addEventListener('load', () => {
                createNotification(parsedResponse.notification)
            });
            script.src = '/api/notification/notification.js';
            document.body.appendChild(script);
            console.log(parsedResponse.notification);
        }
    }
}
submitXHR(new FormData(), '/api/general/getSession.php', handleSession);