function handleCredentialResponse(response) {
    const responsePayload = decodeJwtResponse(response.credential);
    const email = responsePayload.email;
    post('../controllers/login.php', {
        user_email: email,
        user_pass: "gmail",
        gmail_pass: "1"
    });
}

function post(path, params, method='post') {
    const form = document.createElement('form');
    form.method = method;
    form.action = path;
    for (const key in params) {
      if (params.hasOwnProperty(key)) {
        const hiddenField = document.createElement('input');
        hiddenField.type = 'hidden';
        hiddenField.name = key;
        hiddenField.value = params[key];
  
        form.appendChild(hiddenField);
      }
    }
    document.body.appendChild(form);
    form.submit();
}  

function decodeJwtResponse (token) {
    var base64Url = token.split('.')[1];
    var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));
    return JSON.parse(jsonPayload);
};