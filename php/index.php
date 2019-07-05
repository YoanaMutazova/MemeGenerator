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
            echo '<div class="item">';
            echo '<p class="templateName">' . $t["name"] . '</p>';
            echo '<div class="template">';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($t["image"]) . '" class="templateImage image-' . $t["id"] . 
                '" onclick="showTemplate('. $t["id"] . ')"/>';
            echo '</div>';
            echo '</div>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/templates.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    
<body>
    <div id="pad">
        <form action="">
            <input type="text" name="templateName" placeholder="Template name"/>
            <input type="submit" name="search" value="Search"/>
        </form>
        <div class="pad">
            <?php
                if (isset($row)) {
                    generateTemplates($row);
                }
            ?>
        </div>
    </div>
    <div id="nav"> 
        <a href="./php/memes.php"> <button class="btn btn-primary" id="toRated">Like memes</button> </a>
    </div>
    
    <script src="../js/templates.js"></script>
</body>
</html>