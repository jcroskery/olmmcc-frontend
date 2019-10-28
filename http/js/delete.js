function submitDelete() {
    let formData = new FormData();
    formData.append("session", window.localStorage.getItem("session"));
    formData.append("code", document.getElementById('code').value);
    submitXHR(formData, "https://api.olmmcc.tk/delete_account", function () {
        let parsedResponse = JSON.parse(this.responseText);
        if (parsedResponse.success == true) {
            window.localStorage.setItem("notification", "Your account has been successfully deleted.");
            window.localStorage.removeItem("session");
            window.location = "/";
        } else {
            createNotification("Something went wrong. Your code may be incorrect.");
        }
    });
}
document.getElementById('verify').addEventListener('click', submitDelete);
document.getElementById('code').addEventListener('keydown', (event) => {
    if (event.code === 'Enter') {
        submitDelete();
    }
});
