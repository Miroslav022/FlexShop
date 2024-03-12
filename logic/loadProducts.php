<?php
    include "../connection/connection.php";
    
    if($_SERVER["REQUEST_METHOD"]=="POST") {
        
        global $con;
        $num_per_page=9;
        if(isset($_POST['page'])) {
            $page = $_POST['page'];
        } else {
            $page=1;
        }

        $start_from = ($page-1) * $num_per_page;
        
        $upit = "SELECT DISTINCT * FROM products prod INNER JOIN prices pri ON prod.id=pri.product_id INNER JOIN gender_product g on prod.id=g.product_id WHERE prod.is_deleted=0";
        if(isset( $_POST['categoryArray']) && $_POST['categoryArray']!='') {
            $upit.= " AND category_id IN ('".implode("','", $_POST['categoryArray'])."')";  
        }
        if(isset($_POST['brandArray']) && $_POST['brandArray']!='') {
            $upit.= " AND brand_id IN ('".implode("','",$_POST['brandArray'])."')";  
        }
        if(isset($_POST['genderArray']) && $_POST['genderArray']!='') {
            $upit.= " AND gender_id IN ('".implode("','",$_POST['genderArray'])."')";  
        }
        if(isset($_POST['search']) && $_POST['search']!='') {
            $upit .= " AND prod.name LIKE('%".$_POST['search']."%')";
        }

        if(isset($_POST['sortType'])) {
            $sortType = $_POST['sortType'];
            if($sortType=='name_asc') {
                $upit.= " ORDER BY prod.name DESC";
            }
            if($sortType=="name_desc") {
                $upit.= " ORDER BY prod.name ASC";
            }
            if($sortType=="price_asc") {
                $upit.= " ORDER BY pri.price ASC";
            }
            if($sortType=="price_desc") {
                $upit.= " ORDER BY pri.price DESC";
            }

        }

       
        
        $upit.= " LIMIT $start_from,$num_per_page";
        
        

        $products = $con->prepare($upit);
        $products->execute();
        $products = $products->fetchAll(PDO::FETCH_ASSOC);



        if($products){
            echo json_encode($products);
            
            http_response_code(200);
        } else {
            echo json_encode("Sorry, we currently do not have this product.");
            http_response_code(500);

        }

    }

?>