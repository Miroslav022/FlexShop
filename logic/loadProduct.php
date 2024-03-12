<?php
    if( empty(session_id()) && !headers_sent()){
    include "../connection/connection.php";
}
    header("Content-type: appliation/json");
    if($_SERVER["REQUEST_METHOD"]=="POST") {
        
        global $con;
        
        $upit = "SELECT DISTINCT * FROM products prod INNER JOIN prices pri ON prod.id=pri.product_id INNER JOIN brands b ON prod.brand_id=b.id INNER JOIN categories c ON prod.category_id=c.id WHERE prod.is_deleted=0";
        if(isset( $_POST['categoryId']) && $_POST['categoryId']!='') {
            $upit.= " AND category_id=".$_POST['categoryId'];  
        }
        if(isset($_POST['brandId']) && $_POST['brandId']!='') {
            $upit.= " AND brand_id=".$_POST['brandId'];  
        }
        if(isset($_POST['search']) && $_POST['search']!='') {
            $upit .= " AND prod.name LIKE('%".$_POST['search']."%')";
        }

        
        

        $products = $con->prepare($upit);
        $products->execute();
        $products = $products->fetchAll(PDO::FETCH_ASSOC);

        $odg = ['products' => $products];

        if($products){
            echo json_encode($products);
            http_response_code(200);
        } else {
            echo json_encode("Sorry, we currently do not have this product.");
            http_response_code(500);

        }

    }
