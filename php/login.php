<?php
    include_once 'database.php';
    include_once 'user.php';

    $data = json_decode(file_get_contents('php://input'), true);

    $database = new Database();
    $db = $database->getConnection();
    
    $user = new User($db);

    $stmt = $user->getUser($data["username"]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $user_data = array(
        "id" => $row['id'],
        "faculty_number" => $row['faculty_number'],
        "password" => $row['password']
    );

    if (password_verify($data["password"], $user_data["password"])) {

        session_start();

        setcookie("user", $data["username"], time() + 24 * 60 * 60, "/");

        unset($user_data["password"]);

        http_response_code(200);
        echo json_encode($user_data);
    } else {
        http_response_code(400);
        echo json_encode("Невалидно потребителско име или парола.",  JSON_UNESCAPED_UNICODE);
    }
?>