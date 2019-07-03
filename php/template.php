<?php
class Template {
    private $conn;
    private $table_name = "templates";
 
    public function __construct($db) {
        $this->conn = $db;
    }

    function getTemplate($id) {
        $query = "SELECT image FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);

        $stmt->execute();
     
        return $stmt;
    }
    
    function getTemplates() {
        $query = "SELECT id, image, name FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
     
        return $stmt;
    }
}
?>