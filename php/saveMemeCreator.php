<?php
    include_once 'database.php';
    include_once 'uploadImage.php';

    $data = json_decode(file_get_contents('php://input'), true);

    $database = new Database();
    $db = $database->getConnection();
    
    $image = new UploadImage($db);

    $stmt = $image->uploadUser($data["userId"]);

    http_response_code(200);
    echo "uploaded";
?>