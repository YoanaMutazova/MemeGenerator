<?php
    include_once 'database.php';
    include_once 'meme.php';

    $database = new Database();
    $db = $database->getConnection();
    
    $meme = new Meme($db);

    $stmt = $meme->getMemes();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

    function generateMemes($memes) {
        foreach ($memes as $m) {
            echo '<div class="item">';
            echo '<div class="meme">';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($m["image"]) . '" class="memeImage image-' . $m["id"] . '"/>';
            echo '</div>';
            echo '<p>Направено от: ' . $m[""]
            echo '</div>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/memes.css">
<body>
    <div class="memesContainer">
        <?php
            if (isset($row)) {
                generateMemes($row);
            }
        ?>
    </div>
    
    <script src="../js/memes.js"></script>
</body>
</html>