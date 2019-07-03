(function() {
    var urlParams = new URLSearchParams(window.location.search);
    var id = urlParams.get('id');
    var params = { "id": id };

    var xhr = new XMLHttpRequest();

    xhr.open('POST', 'php/templateInfo.php', true);
    xhr.setRequestHeader('Content-type', 'application/json');

    xhr.onreadystatechange = function() {
        var data = xhr.responseText;

        console.log(data)

        if (xhr.readyState == 4 && xhr.status == 200) {
            var image = document.createElement("img");
            image.src = data.replace(/"/g, "").replace(/\\/g, "");

            var hidden = document.getElementById("hiddenImage");
            hidden.appendChild(image);

            var wrapper = document.getElementById("canvasWrapper");
            var canvas = document.getElementById("memeImage");
            var ctx = canvas.getContext("2d");

            var width = image.getBoundingClientRect().width;
            var height = image.getBoundingClientRect().height;

            ctx.canvas.width = width;
            ctx.canvas.height = height;

            wrapper.style.width = width;
            wrapper.style.height = height;

            ctx.drawImage(image, 0, 0, width, height);

        }
    }

    xhr.send(JSON.stringify(params));
})();