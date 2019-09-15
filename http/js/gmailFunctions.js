console.log(window.location.hash);
let formData = new FormData();
formData.append("code", new RegExp('[?&]code=([^&]*)').exec(location.search)[1]);
console.log(formData)
submitXHR(formData, "https://api.olmmcc.tk/send_gmail_code")