<?php
class User {
    private $conn;
    private $table_name = "users";
 
    public function __construct($db) {
        $this->conn = $db;
    }

    function register($data) {
        $data = json_decode($data);

        $query = "INSERT INTO " . $this->table_name . " (username, faculty_number, password) VALUES (?, ?, ?)";
     
        $stmt = $this->conn->prepare($query);
     
        $stmt->bindParam(1, $data->username);
        $stmt->bindParam(2, $data->faculty_number);
        $stmt->bindParam(3, $data->password);
     
        if ($stmt->execute()) {
            return true;
        }
     
        return false;  
    }    

    function getUser($username) {
        $query = "SELECT id, username, faculty_number, password, role FROM " . $this->table_name . " WHERE username = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $username);

        $stmt->execute();
     
        return $stmt;
    }
}
?>