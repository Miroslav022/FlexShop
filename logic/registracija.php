<?php
    header('Content-type: application/json');
    include '../connection/connection.php';

    if($_SERVER['REQUEST_METHOD']=='POST') {
        try {
            $firstName = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $gender = $_POST["gender"];
            $password = $_POST["password"];
            $password = md5($password);
            
            global $con;
    
            $upit = 'INSERT INTO users(first_name,last_name,email,password,gender_id) VALUES(:first_name, :last_name, :email, :password, :gender)';
            $registracija = $con->prepare($upit);
            $registracija->bindParam(":first_name", $firstName);
            $registracija->bindParam(":last_name", $lastname);
            $registracija->bindParam(":email", $email);
            $registracija->bindParam(":gender", $gender);
            $registracija->bindParam(":password", $password);
    
            $registracija = $registracija->execute();
            echo json_encode('uspesno ste se registrovali');
            http_response_code(201);
        } catch(PDOException $e){
            http_response_code(500);
        }      
    } 
    else {
        http_response_code(404);
        header("location: ../index.php");
    }