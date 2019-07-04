<?php
class Meme {
    private $conn;
    private $table_name = "saved_images";
 
    public function __construct($db) {
        $this->conn = $db;
    }
    
    function getMemes() {
        $query = "SELECT image FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
     
        return $stmt;
    }
}
?>