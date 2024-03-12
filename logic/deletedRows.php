<?php
    include '../functions/functions.php';
    include '../connection/connection.php';
    header("Content-type: application/json");
    
    if($_SERVER['REQUEST_METHOD']=='POST') {
        try{
            $table = $_POST['table'];
            $deletedRows = deletedRows($table);
            echo json_encode($deletedRows);
            http_response_code(200);
        } catch(PDOException $e) {
            echo json_encode("Empty");
            http_response_code(500);
        }

    } else {
        http_response_code(500);
    }
  




?>