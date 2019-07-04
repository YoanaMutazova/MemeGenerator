<?php
    include_once 'database.php';
    include_once 'template.php';

    $database = new Database();
    $db = $database->getConnection();
    
    $template = new Template($db);

    $stmt = $template->getTemplates();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

    function generateTemplates($templates) {
        foreach ($templates as $t) {
            echo '<p class="templateName">' . $t["name"] . '</p>';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($t["image"]) . '" class="template template-' . $t["id"] . '"/>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<body>
    <div id="templatesMenu">
        <form id="searchFrom" action="">
            <input type="text" name="templateName" placeholder="Template name"/>
            <input type="submit" name="search" value="Search"/>
        </form>
        <?php
            if (isset($row)) {
                generateTemplates($row);
            }
        ?>
    </div>
    <div id="templateContainer">
        <div id="templateWrapper">
            <div id="canvasWrapper">
                <canvas id="memeImage"></canvas>
            </div>
        </div>
        <div id="templateForm">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" accept="image/*" name="image" onchange="loadFile(event)"/>
                <input class="btn btn-success" type="submit" name="submit" value="UPLOAD"/>
            </form>
        </div>
        <div id="memeOptions">
            <!-- <form id="texts">
                <input type="submit" id="submitText" value="Add" onclick="addText(event)"/>
            </form> -->
            
            <div id="textOptions"></div>
            <button class="btn btn-primary" id="downloadMeme" onclick="downloadMeme()">Download meme</button>
            <button class="btn btn-primary" id="saveMeme" onclick="saveMeme()">Save meme</button>
            
        </div>
        <button class="btn btn-primary" id="fieldsButton" onclick="addTextField()">Add text Field</button>
    </div>

    
    
    <script src="../js/index.js"></script>
</body>
</html>