function redirect(json) {
    if (json.url !== "") {
        window.location.replace(json.url);
    } else {
        window.localStorage.setItem("notification", "Please log in to an administrator account to view this page.");
        window.location = "/login";
    }
}
{
    let form = new FormData();
    form.append("session", window.localStorage.getItem("session"));
    sendReq(form, "https://api.olmmcc.tk/get_gmail_auth_url", redirect);
}