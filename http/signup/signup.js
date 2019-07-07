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
function handleSignup() {
    let parsedResponse = JSON.parse(this.responseText);
    if (!parsedResponse.url) {
        createNotification(parsedResponse.message);
    } else {
        window.location = parsedResponse.url;
    }
}
function submitSignup() {
    let formData = new FormData();
    formData.append('email', document.getElementById('email').value);
    formData.append('username', document.getElementById('username').value);
    formData.append('password1', document.getElementById('password1').value);
    formData.append('password2', document.getElementById('password2').value);
    submitXHR(formData, 'signup.php', handleSignup);
}
document.getElementById('signup').addEventListener('click', submitSignup);
document.getElementById('password2').addEventListener('keydown', (event) => {
    if (event.code === 'Enter') {
        submitSignup();
    }
});
