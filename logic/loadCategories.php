<?php
    include '../connection/connection.php';
    include '../functions/functions.php';
    header('Content-type: application/json');

    if($_SERVER['REQUEST_METHOD']=="POST") {
        try{

            $categories = getCategories();
            echo json_encode($categories);
            http_response_code(200);
        }catch(PDOException $e) {
            http_response_code(500);
        }
         
    }else {
        http_response_code(404);
        header("location: ../products.php");
    }
   



?>