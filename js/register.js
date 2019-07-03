function register(event) {
    event.preventDefault();

    var username = document.getElementById("username").value.trim(),
        facultyNumber = document.getElementById("facultyNumber").value.trim()
    password = document.getElementById("password").value.trim();

    var errors = [];

    if (!username) {
        errors.push(["usernameError", "Моля, въведете потребителско име!"]);
    } else if (username.length > 100) {
        errors.push(["usernameError", "Въведеното потребителско име не е валидно!"]);
    }

    if (!facultyNumber) {
        errors.push(["facultyNumberError", "Моля, въведете факултетен номер!"])
    }

    if (!password) {
        errors.push(["passwordError", "Моля, въведете парола!"]);
    } else if (password.length > 255) {
        errors.push(["passwordError", "Невалидна парола!"]);
    }

    if (errors.length == 0) {
        var params = { 'username': username, 'facultyNumber': facultyNumber, 'password': password };

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'php/register.php', true);
        xhr.setRequestHeader('Content-type', 'application/json');

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 201) {
                // window.location.href = window.location.origin + "/login.html";
                window.location.href = "login.html";
            } else if (xhr.status == 400) {
                var data = xhr.responseText;

                var error = document.getElementById("generalError");
                var text = data.replace(/"/g, "");

                error.innerHTML = text;
                error.style.marginTop = "-15px";
                error.style.display = "block";

                var registerForm = document.getElementsByClassName("pad")[0];
                registerForm.style.height = "465px";
            }
        }

        xhr.send(JSON.stringify(params));
    } else {
        var errorFields = document.getElementsByClassName("error");
        var registerForm = document.getElementsByClassName("pad")[0];

        registerForm.style.height = registerForm.getBoundingClientRect().height - 25 * errorFields.length + "px";

        for (var i = 0; i < errorFields.length; i++) {
            errorFields[i].innerHTML = "";
            errorFields[i].style.display = "none";
        }

        for (var i = 0; i < errors.length; i++) {
            var element = document.getElementById(errors[i][0]);

            element.innerHTML = errors[i][1];
            element.style.marginTop = "-15px";
            element.style.display = "block";
        }

        registerForm.style.height = 430 + 25 * errors.length + "px";
    }
}