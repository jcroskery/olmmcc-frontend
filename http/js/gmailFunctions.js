let formData = new FormData();
formData.append("code", new RegExp('[?&]code=([^&]*)').exec(location.search)[1]);
formData.append("session", window.localStorage.getItem("session"));
submitXHR(formData, "https://api.olmmcc.tk/send_gmail_code")