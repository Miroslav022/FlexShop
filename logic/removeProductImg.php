<?php
        header('Content-type: application/json');
        include '../connection/connection.php';

        if($_SERVER['REQUEST_METHOD']=='POST') {
            try{
                
                $imgId = $_POST["img"];
                $productId = $_POST['productId'];

                if(isset($imgId) && isset($productId)) {
                    global $con;
                    $delete = $con->prepare("DELETE FROM images WHERE product_id=:prodId AND id=:img");
                    $delete->bindParam(":prodId", $productId);
                    $delete->bindParam(":img", $imgId);
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