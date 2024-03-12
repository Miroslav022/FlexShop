<?php
    header('Content-type: application/json');
    include '../connection/connection.php';
    
    if($_SERVER['REQUEST_METHOD']=='POST') {
        try{
            
                $productId = $_POST['id'];
                 global $con;
                $getRewiew = $con->prepare("SELECT * FROM recensions r INNER JOIN users u ON r.user_id=u.user_id WHERE product_id=:id");
                $getRewiew->bindParam(':id', $productId);
                $getRewiew->execute();
                $reviews = $getRewiew->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($reviews);
                http_response_code(201);
            
        }catch(PDOException $e) {
            http_response_code(500);
        }
    } else {
        http_response_code(404);
        header("location: ../editPage.php");
    }