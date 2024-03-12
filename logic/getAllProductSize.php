<?php
    header('Content-type: application/json');
    include '../connection/connection.php';
    
    if($_SERVER['REQUEST_METHOD']=='POST') {
        try{
            $productId = $_POST['productId'];
            
            if(isset($productId)) {

                global $con;
                $allSizes = $con->prepare("SELECT * FROM sizes s INNER JOIN product_size ps ON s.id=ps.size_id WHERE product_id=:id");
                $allSizes->bindParam(':id', $productId);
                $allSizes->execute();
                $allSizes = $allSizes->fetchAll(PDO::FETCH_ASSOC);

                echo json_encode($allSizes);
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