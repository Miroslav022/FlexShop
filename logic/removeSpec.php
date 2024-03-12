<?php
    header('Content-type: application/json');
    include '../connection/connection.php';
    
    if($_SERVER['REQUEST_METHOD']=='POST') {
        try{
            
            $specId = $_POST["specId"];
            $productId = $_POST['productId'];
            
            
            if(isset($specId)) {

                global $con;
                $removespec = $con->prepare("DELETE FROM prod_spec WHERE product_id=:productId AND specification_id=:specId");
                $removespec->bindParam(':productId', $productId);
                $removespec->bindParam(':specId', $specId);
                $remove = $removespec->execute();
                echo json_encode('Success delete');
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