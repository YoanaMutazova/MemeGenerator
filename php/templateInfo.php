<?php
    include_once 'database.php';
    include_once 'template.php';

    $data = json_decode(file_get_contents('php://input'), true);

    $database = new Database();
    $db = $database->getConnection();
    
    $template = new Template($db);

    $stmt = $template->getTemplate($data['id']);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $template_data = array(
        "image" => $row['image']
    );

    $result = 'data:image/jpeg;base64,' . base64_encode($row["image"]);

    http_response_code(200);
    echo json_encode($result);
?>