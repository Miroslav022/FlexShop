<?php
    session_start();
    include '../connection/connection.php';

    if(isset($_POST['btnLogin'])) {
        $email = $_POST['loginMail'];
        $password = $_POST['loginPassword'];
        
        global $con;

        $errors='';
        if(empty($email)) {
            $errors .= "<p>Please enter your email </p>";
        }
        if(empty($password)) {
            $errors .= "<p>Please enter your password</p>";
        }


       if(empty($errors)){
        $password = md5($password);
        $login = $con->prepare("SELECT * FROM users where email = :email AND password = :password");
        $login->bindParam(':email', $email);
        $login->bindParam(':password', $password);
        $login->execute();
        $login = $login->fetch(PDO::FETCH_ASSOC);

           if($login){
            $_SESSION['user'] = $login;
            if($_SESSION['user']['role_id']==1){
                header('location: ../index.php');
            } else if ($_SESSION['user']['role_id']==2) {
                header('location: ../adminpanel/adminpanel.php');
            }
           } else {
            $errors = 'Wrong email or password';
            header("location: ../login-registration.php?errors=$errors");
           }
       } else {
            header("location: ../login-registration.php?errors=$errors");
       }

        
      
        
        }else {
            header("location: ../login-registration.php?error=Incorrect data");
        }
