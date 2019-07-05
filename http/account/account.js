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
function displayResponse() {
    submitXHR(new FormData(), "/api/account/refresh.php", null);
    createNotification(this.responseText);
}
function changeEmail() {
    let formData = new FormData();
    formData.append('newEmail', document.getElementById('email').value);
    submitXHR(formData, "/account/email/", displayResponse);
}
function changeUsername() {
    let formData = new FormData();
    formData.append('username', document.getElementById('username').value);
    submitXHR(formData, "/account/username/", displayResponse);
}
function changeSubscription() {
    let formData = new FormData();
    formData.append('subscriptionPolicy', document.getElementById('subscription').value);
    submitXHR(formData, "/account/subscription/", displayResponse);
}
function changePassword() {
    let formData = new FormData();
    formData.append('currentPassword', document.getElementById('currentPassword').value);
    formData.append('newPassword1', document.getElementById('newPassword1').value);
    formData.append('newPassword2', document.getElementById('newPassword2').value);
    submitXHR(formData, "/account/password/changePassword.php", displayResponse);
}
function deleteAccount() {
    submitXHR(new FormData(), "/account/delete/", displayResponse);
}
function displayDetails() {
    let parsedResponse = JSON.parse(this.responseText);
    document.getElementById('email').value = parsedResponse.email;
    document.getElementById('username').value = parsedResponse.username;
    document.getElementById('subscription').selectedIndex = parsedResponse.subscription_policy;
    if(parsedResponse.admin === 1){
        document.getElementById('adminLabel').textContent += 'Admin';
        let adminButton = document.createElement('button');
        adminButton.id = 'admin';
        adminButton.classList = 'centerDiv inline';
        adminButton.addEventListener('click', () => { window.location = '/admin/'; });
        adminButton.textContent = "Go to Administrator Settings";
        document.getElementById('delete').insertAdjacentElement('afterend', adminButton);
    } else {
        document.getElementById('adminLabel').textContent += 'Member';
    }
}
document.getElementById('changeEmail').addEventListener('click', changeEmail);
document.getElementById('changeUsername').addEventListener('click', changeUsername);
document.getElementById('changeSubscription').addEventListener('click', changeSubscription);
document.getElementById('changePassword').addEventListener('click', changePassword);
document.getElementById('delete').addEventListener('click', deleteAccount);

submitXHR(new FormData(), "/api/account/getDetails.php", displayDetails);
