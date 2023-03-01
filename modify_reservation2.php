<?php

include "includes/functions.php";
$conn = connectDatabase($dsn, $pdoOptions);
session_start();

$reservation = $_GET["reservation"];
$salon = $_GET["salon"];
$duration = $_GET["duration"];
$price = $_GET["price"];
$service_name = $_GET["service_name"];
$date = $_GET["date"];
$time = $_GET["time"];

if (isset($_POST["sub"]) and isset($_POST["s_name2"]) and !empty($_POST["s_name2"]))
{
    $s_name1 = $_POST["s_name2"];

    $sql = "UPDATE reservation SET service_name = '$s_name1' WHERE id_reservation = :reservation";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':reservation',$reservation , PDO::PARAM_STR);
    $stmt->execute();
    header("Location:salon_info.php?ok=12&id=$salon");
}

if (isset($_POST["sub"]) and isset($_POST["price2"]) and !empty($_POST["price2"]))
{
    $s_name1 = $_POST["price2"];

    $sql = "UPDATE reservation SET price = '$s_name1' WHERE id_reservation = :reservation";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':reservation',$reservation , PDO::PARAM_STR);
    $stmt->execute();
    header("Location:salon_info.php?ok=12&id=$salon");
}

if (isset($_POST["sub"]) and isset($_POST["date2"]) and !empty($_POST["date2"]))
{
    $s_name1 = $_POST["date2"];

    $sql = "UPDATE reservation SET date = '$s_name1' WHERE id_reservation = :reservation";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':reservation',$reservation , PDO::PARAM_STR);
    $stmt->execute();
    header("Location:salon_info.php?ok=12&id=$salon");
}

if (isset($_POST["sub"]) and isset($_POST["time2"]) and !empty($_POST["time2"]))
{
    $s_name1 = $_POST["time2"];

    $sql = "UPDATE reservation SET time = '$s_name1' WHERE id_reservation = :reservation";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':reservation',$reservation , PDO::PARAM_STR);
    $stmt->execute();
    header("Location:salon_info.php?ok=12&id=$salon");
}

if (isset($_POST["sub"]) and isset($_POST["duration2"]) and !empty($_POST["duration2"]))
{
    $s_name1 = $_POST["duration2"];

    $sql = "UPDATE reservation SET duration = '$s_name1' WHERE id_reservation = :reservation";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':reservation',$reservation , PDO::PARAM_STR);
    $stmt->execute();
    header("Location:salon_info.php?ok=12&id=$salon");
}
