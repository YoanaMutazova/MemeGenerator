(function() {
    var templates = document.getElementsByClassName("template");

    for (var i = 0; i < templates.length; i++) {
        selectTemplate(templates[i]);
    }
})();

function loadFile(event) {
    var image = document.getElementById('memeImage');
    image.src = URL.createObjectURL(event.target.files[0]);
}

function selectTemplate(element) {
    element.onclick = function() {
        var wrapper = document.getElementById("canvasWrapper");
        var canvas = document.getElementById("memeImage");
        var ctx = canvas.getContext("2d");

        var width = element.getBoundingClientRect().width;
        var height = element.getBoundingClientRect().height;

        ctx.canvas.width = width;
        ctx.canvas.height = height;

        wrapper.style.width = width;
        wrapper.style.height = height;

        ctx.drawImage(element, 0, 0, width, height);
    }
}

// function addText(event) {
//     event.preventDefault();

//     var text = document.getElementById("memeText").value;
//     var memeTexts = document.getElementsByClassName("text");

//     var id = memeTexts == 0 ? 1 : memeTexts.length + 1;

//     if (id >= 11) {
//         console.log("You cannot add more texts!");
//     } else {
//         var textBox = document.createElement("div");
//         textBox.className = "text text-" + id;
//         textBox.innerHTML = text;

//         var wrapper = document.getElementById("templateWrapper");
//         wrapper.appendChild(textBox);
//     }
// }

// function saveMeme() {
//     addTextsToCanvas();

//     var canvas = document.getElementById("memeImage");

//     canvas.toBlob(function(blob){
//         var xhr = new XMLHttpRequest();

//         xhr.open('POST', '../php/saveMeme.php', true);

//         xhr.onreadystatechange = function() {
//             if (xhr.readyState == 4 && xhr.status == 200) {
//                 console.log("uploaded");
//             } else {
//                 console.log("error")
//             }
//         }

//         xhr.send(blob);
//     }, 'image/jpeg', 0.95);
// }

// function fixBinary (bin) {
//     var length = bin.length;
//     var buf = new ArrayBuffer(length);
//     var arr = new Uint8Array(buf);

//     for (var i = 0; i < length; i++) {
//         arr[i] = bin.charCodeAt(i);
//     }

//     return buf;
// }

// function addTextsToCanvas() {
//     var texts = document.getElementsByClassName("text");
//     var canvas = document.getElementById("memeImage");
//     var ctx = canvas.getContext("2d");

//     for (var i = 0; i < texts.length; i++) {
//         ctx.font = "30px Comic Sans MS";
//         ctx.fillStyle = "red";
//         ctx.textAlign = "center";
//         ctx.fillText(texts[i].innerHTML, 100, 100); 
//     }
// }

function addTextField() {
    var wrapper = document.getElementById("canvasWrapper"),
        fields = document.getElementsByClassName("textField"),
        fieldNumber = fields.length + 1;

    var textField = document.createElement("div");
    textField.className = "textField field-" + fieldNumber;
    textField.innerHTML = "Text #" + fieldNumber;

    wrapper.appendChild(textField);

    var offset = [0, 0],
        isDown = false,
        wrapperBounds = wrapper.getBoundingClientRect(),
        textFieldBounds = textField.getBoundingClientRect(),
        isResize = false;

    textField.addEventListener('mousedown', function(e) {
        isDown = true;
        textFieldBounds = textField.getBoundingClientRect();
        offset = [
            textField.offsetLeft - e.clientX,
            textField.offsetTop - e.clientY
        ];
    }, true);

    document.addEventListener('mouseup', function() {
        isDown = false;
    }, true);

    document.addEventListener('mousemove', function(event) {
        event.preventDefault();
        if (isDown && !isResize) {
            var mousePosition = {
                x: event.clientX,
                y: event.clientY
            };

            if (mousePosition.x + offset[0] <= 0) { // left
                textField.style.left = (0) + 'px';
            } else if (mousePosition.x + offset[0] + textFieldBounds.width >= wrapperBounds.width) { // right
                textField.style.left = (wrapperBounds.width - textFieldBounds.width) + 'px';
            } else {
                textField.style.left = (mousePosition.x + offset[0]) + 'px';
            }

            if (mousePosition.y + offset[1] <= 0) { // top
                textField.style.top = (0) + 'px';
            } else if (mousePosition.y + offset[1] + textFieldBounds.height >= wrapperBounds.height) { // bottom
                textField.style.top = (wrapperBounds.height - textFieldBounds.height) + 'px';
            } else {
                textField.style.top = (mousePosition.y + offset[1]) + 'px';
            }
        }
    }, true);

    textField.addEventListener('click', function init() {
        textField.removeEventListener('click', init, false);
        textField.className = textField.className + ' resizable';
        var resizer = document.createElement('div');
        resizer.className = 'resizer';
        textField.appendChild(resizer);
        isResize = true;
        resizer.addEventListener('mousedown', initDrag, false);
    }, false);

    var startX, startY, startWidth, startHeight;

    function initDrag(e) {
        e.stopPropagation();
        startX = e.clientX;
        startY = e.clientY;
        startWidth = parseInt(document.defaultView.getComputedStyle(textField).width, 10);
        startHeight = parseInt(document.defaultView.getComputedStyle(textField).height, 10);
        document.documentElement.addEventListener('mousemove', doDrag, false);
        document.documentElement.addEventListener('mouseup', stopDrag, false);
    }

    function doDrag(e) {
        e.stopPropagation();
        isResize = false;
        textField.style.width = (startWidth + e.clientX - startX) + 'px';
        textField.style.height = (startHeight + e.clientY - startY) + 'px';
    }

    function stopDrag(e) {
        e.stopPropagation();
        document.documentElement.removeEventListener('mousemove', doDrag, false);
        document.documentElement.removeEventListener('mouseup', stopDrag, false);
    }

    var texts = document.getElementById("texts"),
        memeText = document.createElement("input");

    memeText.type = "text";
    memeText.id = "memeText";
    memeText.placeholder = "Text #" + fieldNumber;

    texts.appendChild(memeText);

    var showButton = document.createElement("button");

    showButton.class = "showTextOptions text-" + fieldNumber;
    showButton.innerHTML = "Options";
    showButton.onclick = function(event) {
        event.preventDefault();
        showTextOptions(fieldNumber);
        showButton.onclick = function(event) {
            event.preventDefault();
        };
    }

    texts.appendChild(showButton);
}

function showTextOptions(number) {
    var textOptions = document.getElementById("textOptions");

    var color = document.createElement("input");
    color.className = "textColor";
    color.type = "color";
    textOptions.appendChild(color);

    var fontSize = document.createElement("input");
    fontSize.className = "fontSize";
    fontSize.type = "number";
    fontSize.min = 2;
    fontSize.max = 70;
    textOptions.appendChild(fontSize);

    var align = document.createElement("select");
    align.className = "textAlign";
    textOptions.appendChild(align);

    var center = document.createElement("option");
    center.value = "center";
    center.innerHTML = "Center";
    align.appendChild(center);

    var left = document.createElement("option");
    left.value = "left";
    left.innerHTML = "Left";
    align.appendChild(left);

    var right = document.createElement("option");
    right.value = "right";
    right.innerHTML = "Right";
    align.appendChild(right);

    var verticalAlign = document.createElement("select");
    verticalAlign.className = "verticalAlign";
    textOptions.appendChild(verticalAlign);

    var middle = document.createElement("option");
    middle.value = "middle";
    middle.innerHTML = "Middle";
    verticalAlign.appendChild(middle);

    var top = document.createElement("option");
    top.value = "top";
    top.innerHTML = "Top";
    verticalAlign.appendChild(top);

    var bottom = document.createElement("option");
    bottom.value = "bottom";
    bottom.innerHTML = "Bottom";
    verticalAlign.appendChild(bottom);

    var bold = document.createElement("checkbox");
    bold.className = "bold";
    bold.value = "false";
    textOptions.appendChild(bold);

    var italic = document.createElement("checkbox");
    italic.className = "italic";
    italic.value = "false";
    textOptions.appendChild(italic);
}