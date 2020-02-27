function redirect(json) {
    if (json.url !== "") {
        window.location.replace(json.url);
    } else {
        window.localStorage.setItem("notification", "Please log in to an administrator account to view this page.");
        window.location = "/login";
    }
}
{
    sendReq({}, "https://api.olmmcc.tk/get_gmail_auth_url", redirect);
}