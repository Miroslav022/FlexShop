<?php
    header('Content-type: application/json');
    include '../connection/connection.php';
    
    if($_SERVER['REQUEST_METHOD']=='POST') {
        try{
            
            $sizeId = $_POST["sizeId"];
            $productId = $_POST['productId'];
            $quantity = $_POST['quantity'];
            $userId = $_POST['userId'];
            
            

            global $con;
            $insertToCart = $con->prepare("INSERT INTO cart(product_id, user_id, quantity, size_id) VALUES(:product_id, :user_id, :quantity, :size_id)");
            $insertToCart->bindParam(':product_id', $productId);
            $insertToCart->bindParam(':user_id', $userId);
            $insertToCart->bindParam(':quantity', $quantity);
            $insertToCart->bindParam(':size_id', $sizeId);
            $insert = $insertToCart->execute();
            echo json_encode('Product added to cart');
            http_response_code(201);
        
        }catch(PDOException $e) {
            http_response_code(500);
        }
    } else {
        http_response_code(404);
        header("location: ../cart.php");
    }


?>