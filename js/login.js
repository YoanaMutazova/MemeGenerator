function login(event) {

    event.preventDefault();

    var username = document.getElementById("username").value.trim(),
        password = document.getElementById("password").value.trim();

    var errors = [];

    if (!username.length) {
        errors.push(["usernameError", "Моля, въведете потребителско име!"]);
    }

    if (!password.length) {
        errors.push(["passwordError", "Моля, въведете парола!"]);
    }

    var errorFields = document.getElementsByClassName("error");

    for (var i = 0; i < errorFields.length; i++) {
        errorFields[i].innerHTML = "";
        errorFields[i].style.display = "none";
    }

    if (errors.length == 0) {
        var params = { "username": username, "password": password };

        var xhr = new XMLHttpRequest();

        xhr.open('POST', 'php/login.php', true);

        xhr.setRequestHeader('Content-type', 'application/json');

        xhr.onreadystatechange = function() {
            var data = xhr.responseText;

            if (xhr.readyState == 4 && xhr.status == 200) {
                window.location.href = "php/templates.php";
            } else if (xhr.status == 400) {
                var error = document.getElementById("generalError");
                var text = data.replace(/"/g, "");

                error.innerHTML = text;
                error.style.marginTop = "-15px";
                error.style.display = "block";

                var loginForm = document.getElementsByClassName("pad")[0];
                loginForm.style.height = "465px";
            }
        }

        xhr.send(JSON.stringify(params));
    } else {
        var errorFields = document.getElementsByClassName("error");
        var loginForm = document.getElementsByClassName("pad")[0];

        loginForm.style.height = loginForm.getBoundingClientRect().height - 25 * errorFields.length + "px";

        for (var i = 0; i < errors.length; i++) {
            var element = document.getElementById(errors[i][0]);

            element.innerHTML = errors[i][1];
            element.style.marginTop = "-15px";
            element.style.display = "block";
        }

        loginForm.style.height = 430 + 25 * errors.length + "px";
    }
}