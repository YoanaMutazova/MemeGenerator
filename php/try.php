<?php
    include_once 'database.php';
    include_once 'meme.php';

    $database = new Database();
    $db = $database->getConnection();
    
    $meme = new Meme($db);

    $stmt = $meme->getMemes();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

    function generateTemplates($templates) {
        foreach ($templates as $t) {
            echo '<img src="data:image/jpeg;base64,' . base64_encode($t["image"]) . '"/>';
        }
    }
?>

<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="utf-8">

    <title>Meme Generator</title>
</head>

<body>

    <?php
        if (isset($row)) {
            generateTemplates($row);
        }
    ?>

</body>

</html>