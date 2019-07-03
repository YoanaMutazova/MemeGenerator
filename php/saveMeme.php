<?php
    include_once 'database.php';
    include_once 'uploadImage.php';

    $blob = file_get_contents('php://input');

    $database = new Database();
    $db = $database->getConnection();
    
    $image = new UploadImage($db);

    $stmt = $image->upload($blob);

    var_dump($stmt);

    http_response_code(200);
    echo "uploaded";
?>