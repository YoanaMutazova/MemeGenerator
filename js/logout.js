function logout(sameDepth) {
    clearCookie("user");
    clearCookie("userRole");

    if (sameDepth) {
        window.location.href = "login.html";
    } else {
        window.location.href = "../login.html";
    }
}

function clearCookie(name, domain, path) {
    var domain = domain || document.domain;
    var path = path || "/";
    document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT; domain=" + domain + "; path=" + path;
};