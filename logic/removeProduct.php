<?php
    include '../connection/connection.php';
    include '../functions/functions.php';
    header('Content-type: application/json');

    if($_SERVER['REQUEST_METHOD']=="POST") {
        try{
            $productId = $_POST['id'];

            $remove = removeProduct($productId);
            echo json_encode('Success delete');
            http_response_code(201);
        }catch(PDOException $e) {
            http_response_code(500);
        }
         
    }else {
        http_response_code(404);
        header("location: ../products.php");
    }
   



?>