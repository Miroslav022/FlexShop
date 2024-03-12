<?php
    include '../connection/connection.php';
    if(isset($_POST["updateCategory"])) {
        
            $table = $_POST['table'];
            $id = $_POST['categoryId'];
            $categoryName = $_POST['productName'];

            $errors = 0;
            if(empty($categoryName)) {
                $errors++;
            }
            

            if($errors==0){
                global $con;
                $updateCategory = $con->prepare("UPDATE categories set category_name=:category_name WHERE id=:id");
                $updateCategory->bindParam(':category_name', $categoryName);
                $updateCategory->bindParam(':id', $id );
                $update = $updateCategory->execute();

            if($update) {
                header("Location: ../adminpanel/editPage.php?table=$table&id=$id&message=Succesful");
            }
            
            } else {
                 header("Location: ../adminpanel/editPage.php?table=$table&id=$id&error=Please enter category name");
            }
        } else if(isset($_POST['type'])) {
            $id = $_POST['id'];
            global $con;
            $removeCategory = $con->prepare("UPDATE categories set is_deleted = 1 WHERE id=:id");
            $removeCategory->bindParam(':id', $id);
            $removeCategory = $removeCategory->execute();
            header("Content-type: appliation/json");
            echo json_encode('USPESNO');
        } else if(isset($_POST['newCategory'])){
            $categoryName = $_POST['newCategory'];
            if(!empty($categoryName)) {
                global $con;
                $insertNewCategory = $con->prepare("INSERT INTO categories(category_name) VALUES(:category_name);");
                $insertNewCategory->bindParam(':category_name', $categoryName);
                $insert = $insertNewCategory->execute();
                if($insert) {
                    header("Location: ../adminpanel/addProduct.php?table=categories&message=Succesful");
                } 
            }else {
                    header("Location: ../adminpanel/addProduct.php?table=categories&error=Please neter category name");
                }
        } 
        else {
            header("Location: ../adminpanel/editPage.php?table=$table&id=$id&error=Something is wrong, please try again");
        }


?>