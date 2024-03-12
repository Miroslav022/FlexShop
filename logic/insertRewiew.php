<?php
    header('Content-type: application/json');
    include '../connection/connection.php';
    
    if($_SERVER['REQUEST_METHOD']=='POST') {
        try{
            
            $userId = $_POST['userId'];
            $title = $_POST['title'];
            $message = $_POST['message'];
            $productId = $_POST['productId'];
            $greske=0;
            if(empty($userId) || empty($title) || empty($message)) {
                $greske++;
            }
          
            
            if($greske==0) {

                global $con;
                $insertRewiew = $con->prepare("INSERT INTO recensions(product_id, user_id, content, title) VALUES(:productId, :user_id, :content, :title)");
                $insertRewiew->bindParam(':productId', $productId);
                $insertRewiew->bindParam(':user_id', $userId);
                $insertRewiew->bindParam(':content', $message);
                $insertRewiew->bindParam(':title', $title);
                $insert = $insertRewiew->execute();
                echo json_encode('Success insert');
                http_response_code(201);
            } else echo json_encode('Something is wrong');
        }catch(PDOException $e) {
            http_response_code(500);
        }
    } else {
        http_response_code(404);
        header("location: ../editPage.php");
    }