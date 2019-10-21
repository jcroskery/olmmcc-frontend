function submitVerification() {
    let formData = new FormData();
    formData.append("session", window.localStorage.getItem("unverified_session"));
    formData.append("code", document.getElementById('code').value);
    submitXHR(formData, "https://api.olmmcc.tk/verify_account", function () {
        let parsedResponse = JSON.parse(this.responseText);
        if(parsedResponse.success == true) {
            window.localStorage.setItem("session", window.localStorage.getItem("unverified_session"));
            window.localStorage.removeItem("unverified_session");
            window.localStorage.setItem("notification", "Your account has been successfully verified and you have been logged in!");
            window.location = "/";
        } else {
            window.localStorage.setItem("notification", "Something went wrong. Your code may be incorrect.");
        }
    });
}
document.getElementById('verify').addEventListener('click', submitVerification);
document.getElementById('code').addEventListener('keydown', (event) => {
    if (event.code === 'Enter') {
        submitVerification();
    }
});
