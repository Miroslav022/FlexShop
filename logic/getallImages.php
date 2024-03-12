<?php
    header('Content-type: application/json');
    include '../connection/connection.php';
    
    if($_SERVER['REQUEST_METHOD']=='POST') {
        try{
            $productId = $_POST['productId'];
            
            if(isset($productId)) {

                global $con;
                $allImages = $con->prepare("SELECT * FROM images WHERE product_id=:id");
                $allImages->bindParam(':id', $productId);
                $allImages->execute();
                $allImages = $allImages->fetchAll(PDO::FETCH_ASSOC);

                echo json_encode($allImages);
                http_response_code(200);
            }
        }catch(PDOException $e) {
            http_response_code(500);
        }
    } else {
        http_response_code(404);
        header("location: ../editPage.php");
    }


?>