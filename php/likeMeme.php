<?php
include_once 'database.php';
include_once 'meme.php';

$data = json_decode(file_get_contents('php://input'), true);

$database = new Database();
$db = $database->getConnection();

$meme = new Meme($db);

$stmt = $meme->setLikes($data['id']);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

http_response_code(200);
echo json_encode("updated");
?>