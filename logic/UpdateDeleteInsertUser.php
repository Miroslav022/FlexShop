<?php
    include '../connection/connection.php';
    include '../functions/functions.php';
    if(isset($_POST['updateUser']) || isset($_POST['insertUser'])){
        global $con;
        $greske=0;
        $nameRegex = '/^[A-Z][a-z]{2,14}$/';
        $mailRegex = '/^[A-z0-9-\.]{3,30}@[a-z]{2,8}\.(com|rs)$/';
        $passwordRegex = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/';
        $firstname = $_POST['UFName'];
        $lastName = $_POST['ULName'];
        $email = $_POST['UEmail'];
        $password = $_POST['UNPass'];
        $img = empty($_FILES['profileImg']['name']) ? NULL : $_FILES['profileImg'];
        $gender = $_POST['genders'];
        $role = $_POST['roles'];
        isset($_POST['updateUser']) ? $id = $_POST['userId'] : "";
        
        if(!preg_match($nameRegex, $firstname)) $greske++;
        if(!preg_match($nameRegex, $lastName)) $greske++;
        if(!preg_match($mailRegex, $email)) $greske++;
        if(!preg_match($passwordRegex, $password)) $greske++;

        $noviNazivFajla = null;
        $putanja = null;
        $tmpFajl = null;
        if($img!=NULL){
            $fileName = $img['name'];
            $tmpFajl = $img['tmp_name'];
            $size = $img['size'];
            $type = $img['type'];
            
            $noviNazivFajla = time()."_".$fileName;
            $putanja = "../uploadImg/".$noviNazivFajla;
        }
        if($greske==0) {


            if(move_uploaded_file($tmpFajl, $putanja) || $img == NULL){
                $upit = '';
                if(isset($_POST['updateUser'])) {
                    $upit = "UPDATE users SET first_name=:fName , last_name=:lName , email=:email, gender_id=:gender ,role_id=:role_id";
                if(!empty($password)) {
                    $password = md5($password);
                    $upit.=", password=:password";
                }
                if($img!=NULL) {
                    $upit.=", profile_img=:profile_img";
                }
                $upit.= " WHERE user_id = :id";
                } else if(isset($_POST['insertUser'])) {
                
                    $upit = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `profile_img`, `password`, `role_id`, `gender_id`) VALUES (:fName, :lName, :email, :profile_img, :password, :role_id, :gender)";
                    $password = md5($password);
                }

                
                $editUser = $con->prepare($upit);
                isset($_POST['updateUser']) ? $editUser->bindParam(':id', $id) : '';
                $editUser->bindParam(':fName', $firstname);
                $editUser->bindParam(':lName', $lastName);
                $editUser->bindParam(':email', $email);
 
                if(isset($_POST['updateUser'])) {
                    empty($password) ? '' : $editUser->bindParam(':password', $password);
                } else if(isset($_POST['insertUser'])) {
                    
                    $editUser->bindParam(':password', $password);
                }
                $editUser->bindParam(':gender', $gender);
                if(isset($_POST['updateUser'])) {
                    $img!=NULL ? $editUser->bindParam(':profile_img', $putanja) : '';
                } else if(isset($_POST['insertUser'])) {
                    echo $putanja;
                    $editUser->bindParam(':profile_img', $putanja);
                }
                
                
                $editUser->bindParam(':role_id', $role);
                $edit = $editUser->execute();
                
                if($edit){
                    
                    header("Location: ../adminpanel/users.php");
                    
                    
                } else {
                    echo 'ne valja';
                }
                
            }
        } else {
            header("Location: ../adminpanel/addProduct.php?table=users&error=All fields are required");
        }
        
        
    }else if(isset($_POST['type'])) {
        $id = $_POST['id'];
        global $con;
        $removeUser = $con->prepare("UPDATE users set is_deleted = 1 WHERE user_id=:id");
        $removeUser->bindParam(':id', $id);
        $removeUser = $removeUser->execute();
        header("Content-type: appliation/json");
        echo json_encode('USPESNO');
    } else if(isset($_POST['newUser'])){
       
    } else {
        header('location: ../index.php');
    }