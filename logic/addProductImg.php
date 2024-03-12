<?php
    include '../connection/connection.php';
    if(isset($_POST["submitUpload"])) {
        
            $table = $_POST['table'];

            $id = $_POST['id'];
            $newImg = $_FILES['images'];
            $fileName = $newImg['name'];
            $tmpFajl = $newImg['tmp_name'];
            $size = $newImg['size'];
            $type = $newImg['type'];
            
            $noviNazivFajla = time()."_".$fileName;
            $putanja = "../assets/img/productImg/".$noviNazivFajla;

            if(move_uploaded_file($tmpFajl, $putanja)){
            global $con;
            $insert = $con->prepare('INSERT INTO images (product_id, src) VALUES(:id, :naziv)');
            $insert->bindParam(":id", $id);
            $insert->bindParam(":naziv", $noviNazivFajla);
            $insert = $insert->execute();
            if($insert) {
                header("Location: ../adminpanel/editPage.php?table=$table&id=$id&message=Succesful");
            }
            
            }
        } else {
            header("Location: ../adminpanel/editPage.php?table=$table&id=$id&error=Something is wrong, please try again");
        }


?>