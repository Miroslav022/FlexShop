<?php
    include '../connection/connection.php';
    $id = $_POST['id'];
    $table = $_POST['table'];
    if(isset($_POST['priceBtn'])) {
        $regexPrice = '/^(0(?!\.00)|[1-9]\d{0,6})\.\d{2}$/';
        
        $price = $_POST['newPrice'];
        
        if(preg_match($regexPrice, $price)) {
            global $con;
            $insertPrice = $con->prepare("UPDATE prices set price=:price WHERE product_id=:product_id");
            $insertPrice->bindParam(':price', $price);
            $insertPrice->bindParam(":product_id",$id);
            $insert = $insertPrice->execute();
            if($insert){
                header("Location: ../adminpanel/editPage.php?table=$table&id=$id&message=Successful");
            } else {
                header("Location: ../adminpanel/editPage.php?table=$table&id=$id&error=Somethink is wrong");
            }
        }
        
       


    } else {
        header("Location: ../adminpanel/editPage.php?table=$table&id=$id");
    }



?>