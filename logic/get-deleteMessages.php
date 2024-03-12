<?php
    header('Content-type: application/json');
    include '../connection/connection.php';
    
    if($_SERVER['REQUEST_METHOD']=='POST') {
        try{
            
            if($_POST['type']=="get") {
                
                global $con;
                $getMessages = $con->prepare("SELECT * FROM messages where answered=0");
                $getMessages->execute();
                $messages = $getMessages->fetchAll(PDO::FETCH_ASSOC);
                if($messages) {
                    echo json_encode($messages);
                    http_response_code(200);
                }
            } else if($_POST['type']=='remove') {
                global $con;
                $id = $_POST['id'];
                $removeMessages = $con->prepare("UPDATE messages set answered=1 WHERE message_id=:id");
                $removeMessages->bindParam(":id", $id);
                $remove = $removeMessages->execute();
                
                if($remove) {
                    echo json_encode("Success");
                    http_response_code(202);
                }
            }
            
           
        }catch(PDOException $e) {
            http_response_code(500);
        }
    } else {
        http_response_code(404);
        header("location: ../editPage.php");
    }


?>