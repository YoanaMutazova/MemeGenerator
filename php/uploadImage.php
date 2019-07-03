<?php
class UploadImage {
    private $conn;
    private $table_name = "saved_images";
 
    public function __construct($db) {
        $this->conn = $db;
    }

    function upload($image) {
        $query = "INSERT INTO " . $this->table_name . " (`image`) VALUES (?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $image);

        $stmt->execute();
     
        return $stmt;
    }
}
?>