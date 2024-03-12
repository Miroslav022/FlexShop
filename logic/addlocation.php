<?php
    session_start();
    $user=$_SESSION['user'];
    $id = $user['user_id'];
    include '../connection/connection.php';


    if(isset($_POST['addLocation']) || isset($_POST['addLocationCart'])) {
        $country = $_POST['country'];
        $city = $_POST['city'];
        $address = $_POST['address'];

        global $con;
        $insert = $con->prepare("INSERT INTO locations(country, city, addresses) VALUES(:country, :city, :address)");
        $insert->bindParam(":country", $country);
        $insert->bindParam(':city', $city);
        $insert->bindParam(':address', $address);
        $insert->execute();

        $lastInsertedId = $con->lastInsertId();
        $user['location_id']=$lastInsertedId;

        $insertId = $con->prepare("UPDATE users set location_id=:location_id WHERE user_id=:id");
        $insertId->bindParam(':location_id', $lastInsertedId);
        $insertId->bindParam(":id", $id);
        $insertId->execute();
        $user['location_id']=$lastInsertedId;
        if(isset($_POST['addLocationCart'])) {
            header("Location: ../cart.php?successLoc=Successful");
        } else if (isset($_POST['addLocation'])) {
            header("Location: ../editAccount.php?successLoc=Successful");
        }
        
    }

    if (isset($_POST['updateLocation'])) {
        $country = $_POST['country'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $locId = $_POST['locId'];
        $errors=0;
        if(empty($country) || empty($city) || empty($address) || empty($locId)) {
            $errors++;
        }

        if($errors==0) {
        $update = $con->prepare("UPDATE locations set country=:country, city=:city, addresses=:addresses WHERE id=:id");
        $update->bindParam(':country', $country);
        $update->bindParam(':city', $city);
        $update->bindParam(':addresses', $address);
        $update->bindParam(':id', $locId);
        $update->execute();
        header("Location: ../editAccount.php?successLoc=Successful");
        } else {
            header("Location: ../editAccount.php?errors=Please enter values");
        }

    }

?>