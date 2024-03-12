<?php
    include '../functions/functions.php';
    include '../connection/connection.php';
    header("Content-type: application/json");
    
    if($_SERVER['REQUEST_METHOD']=='POST') {
        try{
            $upit='';
            $table = $_POST['type'];
            $id = $_POST['id'];
            if($table == 'users') {
                $upit = "UPDATE users SET is_deleted=0 WHERE user_id=:id";
            } else {
                $upit = "UPDATE $table SET is_deleted=0 WHERE id=:id";
            }
            global $con;
            $update = $con->prepare($upit);
            $update->bindParam(':id', $id);
            $update->execute();

            echo json_encode('Success');
            http_response_code(200);
        } catch(PDOException $e) {
            echo json_encode("Empty");
            http_response_code(500);
        }

    } else {
        http_response_code(500);
    }
  




?>