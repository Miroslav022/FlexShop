<?php
    header('Content-type: application/json');
    include '../connection/connection.php';
    
    if($_SERVER['REQUEST_METHOD']=='POST') {
        try{
            
            
            
            if(isset($_POST['ids'])) {
                $ids = $_POST['ids'];
                $user = $_POST['idUser'];
                foreach($ids as $id) {
                    global $con;
                    $insertAnswer = $con->prepare("INSERT INTO poll_results(choice_id, user_id) VALUES(:choice_id, :user_id)");
                    $insertAnswer->bindParam(':choice_id', $id);
                    $insertAnswer->bindParam(':user_id', $user);
                    $insert = $insertAnswer->execute();
                }
                echo json_encode('Success insert');
                http_response_code(201);
            } else {
                echo json_encode('Empty data');
            }

                
            
        }catch(PDOException $e) {
            http_response_code(500);
        }
    } else {
        http_response_code(404);
        header("location: ../editPage.php");
    }