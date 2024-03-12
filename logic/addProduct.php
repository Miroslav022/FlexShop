<?php
    include '../connection/connection.php';

    if(isset($_POST['addProduct'])){
        $productName = $_POST['productName'];
        $categoryId = $_POST['categoryId'];
        $brandId = $_POST['brandId'];
        $profileImg = $_FILES['profileImg'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        
        

        $regexPrice = '/^(0(?!\.00)|[1-9]\d{0,6})\.\d{2}$/';

        $greske = 0;
        $insert = '';
        $insertprice = '';
        if(empty($productName)){
            $greske++;
            
        }
        if($greske==0){
            
            
            
            $fileName = $profileImg['name'];
            $tmpFajl = $profileImg['tmp_name'];
            $size = $profileImg['size'];
            $type = $profileImg['type'];
            
            $noviNazivFajla = time()."_".$fileName;
            $putanja = "../assets/img/productImg/".$noviNazivFajla;
            if(move_uploaded_file($tmpFajl, $putanja)){
                global $con;
                $insertProduct = $con->prepare("INSERT INTO products(name, category_id, brand_id, main_img, description) VALUES(:name, :category_id, :brand_id, :img, :description)");
                $insertProduct->bindParam(':name', $productName);
                $insertProduct->bindParam(':category_id', $categoryId);
                $insertProduct->bindParam(':brand_id', $brandId);
                $insertProduct->bindParam(':img', $noviNazivFajla);
                $insertProduct->bindParam(':description', $description);
                $insert = $insertProduct->execute();
            }
            $lastInsertedId = $con->lastInsertId();
        if(isset($menGender)) {
        $menGender =  $_POST['men'];
            global $con;
            $insertGender = $con->prepare("INSERT INTO gender_product (product_id,gender_id) VALUES (:product_id, :gender_id)");
            $insertGender->bindParam(":product_id",$lastInsertedId);
            $insertGender->bindParam(':gender_id', $menGender);
            $insertGender = $insertGender->execute();
        } 
        if(isset($womenGender)) {
            $womenGender = $_POST['women'];
            global $con;
            $insertGender = $con->prepare("INSERT INTO gender_product (product_id,gender_id) VALUES (:product_id, :gender_id)");
            $insertGender->bindParam(":product_id",$lastInsertedId);
            $insertGender->bindParam(':gender_id', $womenGender);
            $insertGender = $insertGender->execute();
        }
        if(preg_match($regexPrice, $price)) {
            global $con;
            $insertPrice = $con->prepare("INSERT INTO prices (price, product_id) VALUES (:price, :product_id)");
            $insertPrice->bindParam(':price', $price);
            $insertPrice->bindParam(":product_id",$lastInsertedId);
            $insertPrice = $insertPrice->execute();
        }
        if($insert){
            header("location: ../adminpanel/products.php");
        }
        
        } else {
            header("Location: ../adminpanel/addProduct.php?table=product&error=All fields are required");
        }
    } else {
         header("location: ../adminpanel/products.php");
    }