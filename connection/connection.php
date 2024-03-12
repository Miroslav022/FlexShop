<?php
    $serverBaze = "localhost";
    $username = "id20461721_webshop"; 
    $password = "5S#^_=>X>>v%pKA_";
    $dataBase = "id20461721_flexfashion";

    try{
        $con = new PDO("mysql:host=$serverBaze;dbname=$dataBase", $username, $password);
        $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "GRESKA U KONEKCIJI SA BAZOM" .$e->getMessage();
    }