<?php
    header('Content-type: application/json');
    include '../connection/connection.php';
    
    if($_SERVER['REQUEST_METHOD']=='POST') {
        try{
            
            $specId = $_POST["specDdl"];
            $productId = $_POST['productId'];
            $value = $_POST['value'];
            
            
            if(isset($specId)) {

                global $con;
                $insertspec = $con->prepare("INSERT INTO prod_spec(product_id, specification_id, value) VALUES(:productId, :specId, :value)");
                $insertspec->bindParam(':productId', $productId);
                $insertspec->bindParam(':specId', $specId);
                $insertspec->bindParam(':value', $value);
                $edit = $insertspec->execute();
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