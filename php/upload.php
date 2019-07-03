<?php

echo json_encode($_FILES["image"]);



// if(isset($_POST["submit"])){
//    $check = getimagesize($_FILES["image"]["tmp_name"]);
//    var_dump(json_encode($_FILES['image']));
//    if($check !== false){
//        $image = $_FILES['image']['tmp_name'];
//        $imgContent = addslashes(file_get_contents($image));
       
//        /*
//         * Insert image data into database
//         */
       
//        //DB details
//        $servername = "localhost";
//        $username = "root";
//        $password = "";

//        try {
//            $conn = new PDO("mysql:host=$servername;dbname=meme_generator", $username, $password);
//            // set the PDO error mode to exception
//            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            echo "Connected successfully";
//            }
//        catch(PDOException $e)
//            {
//            echo "Connection failed: " . $e->getMessage();
//            }
       
//        //Insert image content into database
//        $insert = $db->query("INSERT into upload_images (image) VALUES ('$imgContent')");
//        if($insert){
//            echo "File uploaded successfully.";
//        }else{
//            echo "File upload failed, please try again.";
//        } 
//    }else{
//        echo "Please select an image file to upload.";
//    }
// }