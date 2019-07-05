<?php
class Meme {
    private $conn;
    private $table_name = "saved_images";
 
    public function __construct($db) {
        $this->conn = $db;
    }
    
    function getMemes() {
        $query = "SELECT id, image, user_id, rate FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
     
        return $stmt;
    }
}
?>