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
function changeDisplayedUsername() {
    let parsedResponse = JSON.parse(this.responseText);
    let accountLinks = document.querySelectorAll("a[href='/account/']");
    for (let i = 0; i < accountLinks.length; i++) {
        accountLinks[i].textContent = "Welcome, " + parsedResponse.username;
    }
}
function displayResponse() {
    let refreshForm = new FormData();
    refreshForm.append("session", window.localStorage.getItem("session"));
    submitXHR(refreshForm, "https://api.olmmcc.tk/refresh", 
        () => {
            let refreshForm = new FormData();
            refreshForm.append("session", window.localStorage.getItem("session"));
            refreshForm.append("details", "username");
            submitXHR(refreshForm, 'https://api.olmmcc.tk/get_account', changeDisplayedUsername);
        }
    );
    createNotification(JSON.parse(this.responseText).message);
}
function changeEmail() {
    let formData = new FormData();
    let email = document.getElementById('email').value;
    formData.append("session", window.localStorage.getItem("session"));
    formData.append('email', email);
    submitXHR(formData, "https://api.olmmcc.tk/send_change_email", function () {
        let parsedResponse = JSON.parse(this.responseText);
        if (parsedResponse.success) {
            window.localStorage.setItem("notification", "An email containing a verification code for your email change request has been sent to " + parsedResponse.email + ". Please check your inbox, including the spam folder, for the link. It may take a few minutes to receive the email.");
            window.location = "/account/email";
        } else if (parsedResponse.message) {
            createNotification(parsedResponse.message);
        }
    });
}
function changeUsername() {
    let formData = new FormData();
    formData.append("session", window.localStorage.getItem("session"));
    formData.append('username', document.getElementById('username').value);
    submitXHR(formData, "https://api.olmmcc.tk/change_username", displayResponse);
}
function changeSubscription() {
    let formData = new FormData();
    formData.append("session", window.localStorage.getItem("session"));
    formData.append('subscription', document.getElementById('subscription').value);
    submitXHR(formData, "https://api.olmmcc.tk/change_subscription", displayResponse);
}
function changePassword() {
    let formData = new FormData();
    formData.append('password1', document.getElementById('newPassword1').value);
    formData.append('password2', document.getElementById('newPassword2').value);
    formData.append("session", window.localStorage.getItem("session"));
    submitXHR(formData, "https://api.olmmcc.tk/send_password_email", function () {
        let parsedResponse = JSON.parse(this.responseText);
        if (parsedResponse.success) {
            window.localStorage.setItem("notification", "An email containing a verification code for your password change request has been sent to " + parsedResponse.email + ". Please check your inbox, including the spam folder, for the link. It may take a few minutes to receive the email.");
            window.location = "/account/password/verify";
        } else if (parsedResponse.message) {
            createNotification(parsedResponse.message);
        }
    });
}
function deleteAccount() {
    let formData = new FormData();
    formData.append("session", window.localStorage.getItem("session"));
    submitXHR(formData, "https://api.olmmcc.tk/send_delete_email", function () {
        let parsedResponse = JSON.parse(this.responseText);
        if (parsedResponse.success) {
            window.localStorage.setItem("notification", "An email containing a verification code for your account deletion request has been sent to " + parsedResponse.email + ". Please check your inbox, including the spam folder, for the link. It may take a few minutes to receive the email.");
            window.location = "/account/delete";
        } else if (parsedResponse.message) {
            createNotification(parsedResponse.message);
        }
    });
}
function displayDetails() {
    if (!this.responseText) { //Not logged in
        let formData = new FormData();
        formData.append('admin', 0);
        submitXHR(formData, '/api/notification/createLoginNotification.php', () => { window.location = '/login/'; })
        return;
    }
    let parsedResponse = JSON.parse(this.responseText);
    document.getElementById('email').value = parsedResponse.email;
    document.getElementById('username').value = parsedResponse.username;
    document.getElementById('subscription').selectedIndex = parsedResponse.subscription_policy;
    if (parsedResponse.admin === "1") {
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

let accountForm = new FormData();
accountForm.append("details", 
    JSON.stringify(["username", "email", "subscription_policy", "admin"])
);
accountForm.append("session", window.localStorage.getItem("session"));
submitXHR(accountForm, "https://api.olmmcc.tk/get_account", displayDetails);
