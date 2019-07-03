<?php

echo json_encode($_FILES["image"]);

//DB details
        $db = "meme_generator";
        $servername = "localhost";
        $username = "root";
        $password = "";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=meme_generator", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }

 if(isset($_POST["submit"])){
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    var_dump(json_encode($_FILES['image']));
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
       
        //Insert image content into database
        $query=$conn->prepare("INSERT INTO upload_images(image) VALUES ('$imgContent')");
        if($query->execute()){
            echo "File uploaded successfully.";
        }else{
            echo "File upload failed, please try again.";
        } 
    }else{
        echo "Please select an image file to upload.";
    }
 }