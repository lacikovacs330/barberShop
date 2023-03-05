<?php

include "includes/functions.php";
$conn = connectDatabase($dsn, $pdoOptions);
session_start();

if (isset($_POST["sub"]) and isset($_POST["s_name1"]) and !empty($_POST["s_name1"]))
{
    $s_name = $_GET["s_name"];
    $s_name1 = $_POST["s_name1"];
    $service = $_GET["service"];

    $sql = "UPDATE services SET service_name = '$s_name1' WHERE id_service = :service";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':service',$service , PDO::PARAM_STR);
    $stmt->execute();

    
    header("Location:add_services.php?ok=9");
}
else
{
    header("Location:add_services.php");
}

if (isset($_POST["sub"]) and isset($_POST["price1"]) and !empty($_POST["price1"]))
{
    $price = $_GET["price"];
    $price1 = $_POST["price1"];
    $service = $_GET["service"];

    $sql = "UPDATE services SET price = '$price1' WHERE id_service = :service";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':service',$service , PDO::PARAM_STR);
    $stmt->execute();
    header("Location:add_services.php?ok=9");
}
else
{
    header("Location:add_services.php");
}

if (isset($_POST["sub"]) and isset($_POST["duration1"]) and !empty($_POST["duration1"]))
{
    $duration = $_GET["duration"];
    $duration1 = $_POST["duration1"];
    $service = $_GET["service"];

    $sql = "UPDATE services SET duration = '$duration1' WHERE id_service = :service";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':service',$service , PDO::PARAM_STR);
    $stmt->execute();
    header("Location:add_services.php?ok=9");
}
else
{
    header("Location:add_services.php");
}


