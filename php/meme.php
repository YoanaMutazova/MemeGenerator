<?php
class Meme {
    private $conn;
    private $table_name = "saved_images";
 
    public function __construct($db) {
        $this->conn = $db;
    }
    
    function getMemes() {
        $query = "SELECT id, image, user, rate FROM " . $this->table_name . " ORDER BY rate DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
     
        return $stmt;
    }

    function setLikes($id) {
        $query = "UPDATE " . $this->table_name . " SET `rate`=(SELECT `rate` FROM (SELECT * FROM " . $this->table_name 
            . " WHERE `id`=(?)) AS si)+1 WHERE `id`=(?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $id);

        $stmt->execute();
        
        return $stmt;
        
    }
}
?>