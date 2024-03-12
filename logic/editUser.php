<?php
    session_start();
    $user=$_SESSION['user'];
    $id = $user['user_id'];
    include '../connection/connection.php';
    include '../functions/functions.php';
    if(isset($_POST['edit'])){
        global $con;
        $greske=0;
        $nameRegex = '/^[A-Z][a-z]{2,14}$/';
        $mailRegex = '/^[A-z0-9-\.]{3,30}@[a-z]{2,8}\.(com|rs)$/';
        $passwordRegex = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/';
        $firstname = isset($_POST['UFName']) ? $_POST['UFName'] : $user['first_name'];
        $lastName = isset($_POST['ULName']) ? $_POST['ULName'] : $user['last_name'];
        $email = isset($_POST['UEmail']) ? $_POST['UEmail'] : $user['email'];
        $password = empty($_POST['UNPass']) ? $user['password'] : md5($_POST['UNPass'] );
        $img = empty($_FILES['profileImg']['name']) ? $user['profile_img'] : $_FILES['profileImg'];
        $gender = isset($_POST['genders']) ? $_POST['genders'] : $user['gender_id'];

        $message='';
        function checkValues($value, $regex, $greske, $msg) {
            if(!preg_match($regex, $value)) {
                global $greske;
                global $message;
                $message.=$msg;
                $greske++;
            };
            
        }
        checkValues($firstname, $nameRegex, $greske, "<p>Incorrect First name: Example (Miroslav)</p>");
        checkValues($lastName, $nameRegex, $greske, "<p>Incorrect Last name: Example (Jandric)</p>");
        checkValues($email, $mailRegex, $greske, "<p>Incorrect Email: Example (miroslav@gmail.com)</p>");
        if($password!=$user['password']) checkValues($password, $passwordRegex, $greske);
        

        

        $noviNazivFajla = null;
        $putanja = $user['profile_img'];
        $tmpFajl = null;
        if($img!=$user['profile_img']){
            $fileName = $img['name'];
            $tmpFajl = $img['tmp_name'];
            $size = $img['size'];
            $type = $img['type'];
            $greske = 0;
            $imgType= ["image/png", "image/jpeg", "image/webp"];
            
             if(!in_array($type, $imgType)){
            $greske++;
            header("Location: ../editAccount.php?&success=Allowed formats(png, jpg/jpeg)");
            }
            $noviNazivFajla = time()."_".$fileName;
            $putanja = "../uploadImg/".$noviNazivFajla;
        }
        if($greske==0) {
            if(move_uploaded_file($tmpFajl, $putanja) || $img == $user['profile_img']){
        
                
                $editUser = $con->prepare("UPDATE users SET first_name=:fName , last_name=:lName , email=:email , password=:password , gender_id=:gender , profile_img=:profile_img  WHERE user_id = :id");
                $editUser->bindParam(':id', $id);
                $editUser->bindParam(':fName', $firstname);
                $editUser->bindParam(':lName', $lastName);
                $editUser->bindParam(':email', $email);
                $editUser->bindParam(':password', $password);
                $editUser->bindParam(':gender', $gender);
                $editUser->bindParam(':profile_img', $putanja);
                $edit = $editUser->execute();
                if($edit){
                    
                    header('Location: ../editAccount.php?success=You are successfully edit your account');
                    setNewValueInSessionForUser($firstname, $lastName, $email, $putanja, $password, $gender);
                } else {
                    echo 'ne valja';
                }
                
            }
        } else {
            header("location: ../editAccount.php?success=$message");
        }
        
        
    }else {
        header('location: ../index.php');
    }