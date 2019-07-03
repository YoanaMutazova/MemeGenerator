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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/templates.css">
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
    
    <script src="../js/templates.js"></script>
</body>
</html>