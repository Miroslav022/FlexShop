<?php
    header('Content-type: application/json');
    include '../connection/connection.php';
    
    if($_SERVER['REQUEST_METHOD']=='POST') {
        try{
            
            $specId = $_POST["specId"];
            $productId = $_POST['productId'];
            $value = $_POST['value'];
            
            if(isset($specId)) {
                
                global $con;
                $editspec = $con->prepare("UPDATE prod_spec SET value=:value WHERE product_id=:productId AND specification_id=:specId");
                $editspec->bindParam(':productId', $productId);
                $editspec->bindParam(':specId', $specId);
                $editspec->bindParam(':value', $value);
                $edit = $editspec->execute();
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