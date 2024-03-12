<?php
    header('Content-type: application/json');
    include '../connection/connection.php';
    
    if($_SERVER['REQUEST_METHOD']=='POST') {
        try{
            
            $sizeId = $_POST["id"];
            $productId = $_POST['productId'];
            
            if(isset($sizeId)) {

                global $con;
                $insertSize = $con->prepare("INSERT INTO product_size (product_id, size_id) VALUES(:productId, :sizeId)");
                $insertSize->bindParam(':productId', $productId);
                $insertSize->bindParam(':sizeId', $sizeId);
                $insert = $insertSize->execute();
                echo json_encode('Success insert');
                http_response_code(201);
            }
        }catch(PDOException $e) {
            http_response_code(500);
        }
    } else {
        http_response_code(404);
        header("location: ../editPage.php");
    }


?>