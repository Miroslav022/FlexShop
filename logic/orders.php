<?php
    header('Content-type: application/json');
    include '../connection/connection.php';
    
    if($_SERVER['REQUEST_METHOD']=='POST') {
        try{
            $user = $_POST['user'];
            $total = $_POST['total'];
            $products = $_POST['products'];


            global $con;
            $orders = $con->prepare('INSERT INTO orders(user_id, total) VALUES (:user_id, :total)');
            $orders->bindParam(":user_id", $user);
            $orders->bindParam(":total", $total);
            $orders->execute();

            $orderId = $con->lastInsertId();

            foreach($products as $product) {
                

                    $upit = "INSERT INTO product_order(product_id, price, quantity, location_id, size_id, order_id) VALUES(:product, :price, :quantity, :location, :size, :order)";
                    global $con;
                    $productOrder = $con->prepare($upit);
                    $productOrder->bindParam("product", $product['product']);
                    $productOrder->bindParam("price", $product['price']);
                    $productOrder->bindParam("quantity", $product['qty']);
                    $productOrder->bindParam("location", $product['location']);
                    $productOrder->bindParam("size", $product['sizeId']);
                    $productOrder->bindParam("order", $orderId);
                    $isPurcheased = $productOrder->execute();
                    if($isPurcheased) {
                        $changeStatus = $con->prepare("UPDATE cart SET is_purchased=1 WHERE cart_id=:cart");
                        $changeStatus->bindParam(":cart", $product['cart']);
                        $changeStatus->execute();
                    }
                    
                    
               
            }
            echo json_encode('Successful order');
            http_response_code(200);
        
        }catch(PDOException $e) {
            http_response_code(500);
        }
    } else {
        http_response_code(404);
        header("location: ../cart.php");
    }


?>