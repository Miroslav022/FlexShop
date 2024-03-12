<?php
    include '../connection/connection.php';
    include '../functions/functions.php';

    if(isset($_POST['updateProduct'])){
        $productName = $_POST['productName'];
        $categoryId = $_POST['categoryId'];
        $brandId = $_POST['brandId'];
        // $profileImg = $_FILES['profileImg'];
        $actualImg = $_POST['actualImg'];
        $profileImg = empty($_FILES['profileImg']['name']) ? $actualImg : $_FILES['profileImg'];
        $productId = $_POST['id'];
        $table = $_POST['table'];
        $description = $_POST['description'];

        $greske = 0;
        if(empty($productName)){
            $greske++;
            header("Location: ../adminpanel/editPage.php?table=$table&id=$productId&error=Please enter product name");
        }

       $update = '';
       if($profileImg==$actualImg) {
            global $con;
            $updateProduct = $con->prepare("UPDATE products SET name=:name, category_id=:category_id, brand_id=:brand_id, description=:description WHERE id = :product_id");
            $updateProduct->bindParam(':name', $productName);
            $updateProduct->bindParam(':category_id', $categoryId);
            $updateProduct->bindParam(':brand_id', $brandId);
            $updateProduct->bindParam(':description', $description);
            $updateProduct->bindParam(':product_id', $productId);
            $update = $updateProduct->execute();
       } else {
            $fileName = $profileImg['name'];
            $tmpFajl = $profileImg['tmp_name'];
            $size = $profileImg['size'];
            $type = $profileImg['type'];
            $greske = 0;
            $imgType= ["image/png", "image/jpeg", "image/webp"];
            
             if(!in_array($type, $imgType)){
            $greske++;
            header("Location: ../adminpanel/editPage.php?table=$table&id=$productId&error=Allowed formats(png, jpg/jpeg)");
        }

            
          if($greske==0) {
                $noviNazivFajla = time()."_".$fileName;

            $putanja = "../assets/img/productImg/".$noviNazivFajla;
            if(move_uploaded_file($tmpFajl, $putanja)){
                global $con;
                $updateProduct = $con->prepare("UPDATE products SET name=:name, category_id=:category_id, brand_id=:brand_id, main_img=:img ,description=:description WHERE id=:product_id");
                $updateProduct->bindParam(':name', $productName);
                $updateProduct->bindParam(':category_id', $categoryId);
                $updateProduct->bindParam(':brand_id', $brandId);
                $updateProduct->bindParam(':img', $noviNazivFajla);
                $updateProduct->bindParam(':description', $description);
                $updateProduct->bindParam(':product_id', $productId);
                $update = $updateProduct->execute();
            }
          }
       }

       if($update) {
        header("Location: ../adminpanel/editPage.php?table=$table&id=$productId&message=Success Update");
       } else {
        header("Location: ../adminpanel/editPage.php?table=$table&id=$productId&error=Something is wrong");
       }

    }
    if(isset($_POST['removeProduct'])){
        $productId = $_POST['id'];
        $table = $_POST['table'];
        // global $con;
        // $remove = $con->prepare("UPDATE products SET is_deleted = 1 WHERE id=:id");
        // $remove->bindParam(":id", $productId);
        // $remove = $remove->execute();
        $remove = removeProduct($productId);
        if($remove) {
            header("Location: ../adminpanel/editPage.php?table=$table&id=$productId&message=You are successfuly remove product");
        } else {
            header("Location: ../adminpanel/editPage.php?table=$table&id=$productId&message=Something is wrong");
        }
    }