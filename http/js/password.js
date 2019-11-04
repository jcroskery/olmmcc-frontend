function submitChange() {
    let formData = new FormData();
    formData.append("session", window.localStorage.getItem("session"));
    formData.append("code", document.getElementById('code').value);
    submitXHR(formData, "https://api.olmmcc.tk/change_password", function () {
        let parsedResponse = JSON.parse(this.responseText);
        if (parsedResponse.success == true) {
            window.localStorage.removeItem("session");
            window.localStorage.setItem("notification", "Your password has been successfully changed. Please log in to your account with your new password.");
            window.location = "/login";
        } else {
            createNotification("Something went wrong. Your code may be incorrect.");
        }
    });
}
document.getElementById('verify').addEventListener('click', submitChange);
document.getElementById('code').addEventListener('keydown', (event) => {
    if (event.code === 'Enter') {
        submitChange();
    }
});
