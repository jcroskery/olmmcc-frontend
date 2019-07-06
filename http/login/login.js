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
function handleLogin() {
    let parsedResponse = JSON.parse(this.responseText);
    if(parsedResponse.url === '') {
        createNotification(parsedResponse.message);
    } else {
        window.location = parsedResponse.url;
    }
}
function submitLogin() {
    let formData = new FormData();
    formData.append('email', document.getElementById('email').value);
    formData.append('password', document.getElementById('password').value);
    submitXHR(formData, 'login.php', handleLogin);
}
document.getElementById('login').addEventListener('click', submitLogin);
document.getElementById('password').addEventListener('keydown', (event) => {
    if (event.code === 'Enter') {
        submitLogin();
    }
});
