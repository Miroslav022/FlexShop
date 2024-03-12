<?php
    include "../connection/connection.php";
    header("Content-type: appliation/json");

    if($_SERVER["REQUEST_METHOD"]=="POST") {
        
        // $gender = $_POST['genderArray'];
        // $category = $_POST['categoryArray'];
        // $brand = $_POST['brandArray'];

        $upit = 'SELECT * FROM products prod INNER JOIN prices pri ON prod.id=pri.product_id WHERE is_deleted=0';

        if(isset( $_POST['categoryArray']) && $_POST['categoryArray']!='') {
            $upit.= " AND category_id IN ('".implode("','", $_POST['categoryArray'])."')";  
        }
        if(isset($_POST['brandArray']) && $_POST['brandArray']!='') {
            $upit.= " AND brand_id IN ('".implode("','",$_POST['brandArray'])."')";  
        }

        $filter = $con->prepare($upit);
        $filter->execute();
        $filter=$filter->fetchAll(PDO::FETCH_ASSOC);

        // echo '<pre>';
        // var_dump($filter); 
        // echo '</pre>';
       

        if($filter){
            echo json_encode($filter);
            http_response_code(200);
        } else {
            echo json_encode("nesto nije u redu");
            http_response_code(500);

        }

    }


?>