<?php
    include '../connection/connection.php';
    if(isset($_POST["updateBrand"])) {
        
            $table = $_POST['table'];
            $id = $_POST['brandId'];
            $brandName = $_POST['brandName'];

            $errors = 0;
            if(empty($brandName)) {
                $errors++;
            }
            

            if($errors==0){
                global $con;
                $updateBrand = $con->prepare("UPDATE brands set brand_name=:brand_name WHERE id=:id");
                $updateBrand->bindParam(':brand_name', $brandName);
                $updateBrand->bindParam(':id', $id );
                $update = $updateBrand->execute();

            if($update) {
                header("Location: ../adminpanel/editPage.php?table=brands&id=$id&message=Succesful");
            }
            
            }else {
               header("Location: ../adminpanel/editPage.php?table=brands&id=$id&error=Something is wrong");
            }
        } else if(isset($_POST['type'])) {
            $id = $_POST['id'];
            global $con;
            $removeBrand = $con->prepare("UPDATE brands set is_deleted = 1 WHERE id=:id");
            $removeBrand->bindParam(':id', $id);
            $removeBrand = $removeBrand->execute();
            header("Content-type: appliation/json");
            echo json_encode('USPESNO');
        } else if(isset($_POST['newBrand'])){
            $brandName = $_POST['newBrand'];
            if(!empty($brandName)) {
                global $con;
                $insertNewBrand = $con->prepare("INSERT INTO brands(brand_name) VALUES(:brand_name);");
                $insertNewBrand->bindParam(':brand_name', $brandName);
                $insert = $insertNewBrand->execute();
                if($insert) {
                    header("Location: ../adminpanel/addProduct.php?table=brand&message=Succesful");
                } else {
                    header("Location: ../adminpanel/addProduct.php?table=brand&error=Something is wrong");
                }
            } else {
                header("Location: ../adminpanel/addProduct.php?table=brand&error=Please enter brand name");
            }
        } 
        else {
            header("Location: ../adminpanel/editPage.php?table=brand&id=$id&error=Something is wrong, please try again");
        }


?>