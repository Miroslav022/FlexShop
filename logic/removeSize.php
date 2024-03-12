<?php
        header('Content-type: application/json');
        include '../connection/connection.php';

        if($_SERVER['REQUEST_METHOD']=='POST') {
            try{
                
                $sizeId = $_POST["sizeId"];
                $productId = $_POST['productId'];
                
                if(isset($sizeId) && isset($productId)) {
                    global $con;
                    $delete = $con->prepare("DELETE FROM product_size WHERE product_id=:prodId AND size_id=:sizeId");
                    $delete->bindParam(":prodId", $productId);
                    $delete->bindParam(":sizeId", $sizeId);
                    $delete->execute();
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