<?php
    include_once 'database.php';
    include_once 'user.php';

    $data = json_decode(file_get_contents('php://input'), true);

    $database = new Database();
    $db = $database->getConnection();
    
    $user = new User($db);

    $username = htmlentities($data['username']);
    $faculty_number = htmlentities($data['facultyNumber']);
    $password = htmlentities($data['password']);

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $user_data = array("username" => $username, "faculty_number" => $faculty_number, "password" => $password_hash);

    if ($user->register(json_encode($user_data))) {
        http_response_code(201);
        echo json_encode("created");
    } else {
        http_response_code(400);
        echo json_encode("Вече има регистриран потребител с този факултетен номер!", JSON_UNESCAPED_UNICODE);
    }
?>