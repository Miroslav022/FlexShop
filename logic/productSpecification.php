<?php
    header("Conetnt-type: application/json");
    include '../connection/connection.php';
    if($_SERVER['REQUEST_METHOD']=="POST") {
        try{
            global $con;
            $id = $_POST['id'];
            $price = $con->prepare("SELECT * FROM prod_spec ps INNER JOIN specifications s ON ps.specification_id=s.id where product_id=:id");
            $price->bindParam(":id", $id);
            $price->execute();
            $price = $price->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($price);
        } catch(PDOException $e) {
            http_response_code(500);
        }

    } else {
        http_response_code(404);
        header("location: ../editPage.php");
    }
?>