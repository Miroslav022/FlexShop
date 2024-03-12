<?php
    header('Content-type: application/json');
    include '../connection/connection.php';
    
    if($_SERVER['REQUEST_METHOD']=='POST') {
        try{
            
            if($_POST['type']=='get') {
                
                global $con;
                $user = $_POST['user'];

                $getProducts = $con->prepare("SELECT * FROM cart c INNER JOIN products pr ON c.product_id=pr.id INNER JOIN users u ON c.user_id=u.user_id INNER JOIN sizes s ON c.size_id=s.id INNER JOIN prices price ON pr.id =price.product_id WHERE u.user_id=:user AND c.is_purchased=0;
                ");

                $getProducts->bindParam(':user', $user);
                $getProducts->execute();
                $products = $getProducts->fetchAll(PDO::FETCH_ASSOC);
                

                if($products){
                    if(sizeof($products)>0) {
                        echo json_encode($products);
                    } else if (sizeof($products)==0) {
                        echo json_encode('Empty');
                    }
                    http_response_code(200);
                }
            }else if($_POST['type']=='remove') {
                $id = $_POST['cartID'];
                global $con;
                $remove = $con->prepare("DELETE FROM cart where cart_id = :id");
                $remove->bindParam(":id", $id);
                $remove->execute();
                echo json_encode("success remove");
                http_response_code(200);
            }
            
            

        
        }catch(PDOException $e) {
            http_response_code(500);
        }
    } else {
        http_response_code(404);
        header("location: ../cart.php");
    }


?>