function redirect() {
    if (this.responseText !== "") {
        window.location.replace(this.responseText);
    } else {
        window.localStorage.setItem("notification", "Please log in to an administrator account to view this page.");
        window.location = "/login";
    }
}
{
    let form = new FormData();
    form.append("session", window.localStorage.getItem("session"));
    submitXHR(form, "https://api.olmmcc.tk/get_gmail_auth_url", redirect);
}