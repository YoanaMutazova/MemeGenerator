function showMeme(id) {
    window.location.href = "../meme.html?id=" + id;
}

function likeMeme(id) {
    var params = { "id": id };

    var xhr = new XMLHttpRequest();

    xhr.open('POST', '../php/likeMeme.php', true);

    xhr.setRequestHeader('Content-type', 'application/json');

    xhr.onreadystatechange = function() {
        var number = document.getElementsByClassName("rate-" + id)[0];
        var inner = parseInt(number.innerHTML) + 1;
        number.innerHTML = inner.toString();

        var button = document.getElementsByClassName("like-" + id)[0];
        button.disabled = true;
        button.classList.add("disabled");
    }

    xhr.send(JSON.stringify(params));
}