<?php
class UploadImage {
    private $conn;
    private $table_name = "saved_images";
 
    public function __construct($db) {
        $this->conn = $db;
    }

    function upload($data) {
        $query = "INSERT INTO " . $this->table_name . " (`image`) VALUES (?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $data);

        $stmt->execute();
     
        return $stmt;
    }

    function uploadUser($userId) {
        $query = "UPDATE " . $this->table_name . " SET `user_id` = (?) WHERE `id` = (SELECT MAX(`id`) FROM (SELECT * FROM " . $this->table_name 
        . ") AS si)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $userId);

        $stmt->execute();
     
        return $stmt;
    }
}
?>