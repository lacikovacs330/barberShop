<?php

session_start();

include "includes/functions.php";

$conn = connectDatabase($dsn, $pdoOptions);

if (isset($_POST["archived"]))
{
    $name = $_POST["id_reservation"];
    $id = $_POST["id"];

    $sql = "SELECT * FROM reservation WHERE id_reservation = '$name'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) {
        foreach ($results as $row) {
            $id_salon = $row["id_salon"];
            $id_worker_user = $row["id_worker_user"];
            $id_user = $row["id_user"];
            $username = $row["username"];
            $email = $row["email"];
            $duration = $row["duration"];
            $price = $row["price"];
            $service_name = $row["service_name"];
            $date = $row["date"];
            $time = $row["time"];


            $pdoQuery = $conn->prepare("INSERT INTO reservation_archived (id_reservation ,id_salon,id_worker_user ,id_user ,username,email,duration,price,service_name,date,time) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
            $pdoQuery->execute([$name,$id_salon,$id_worker_user,$id_user,$username,$email,$duration,$price,$service_name,$date,$time]);
        }
    }


    $sql = "DELETE FROM reservation WHERE id_reservation=?";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$name]);

    header("Location:salon_info.php");
}

if (isset($_POST["archived1"]))
{
    $name = $_POST["id_reservation"];
    $id = $_POST["id"];

    $sql = "SELECT * FROM reservation_archived WHERE id_reservation = '$name'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) {
        foreach ($results as $row) {
            $id_salon = $row["id_salon"];
            $id_worker_user = $row["id_worker_user"];
            $id_user = $row["id_user"];
            $username = $row["username"];
            $email = $row["email"];
            $duration = $row["duration"];
            $price = $row["price"];
            $service_name = $row["service_name"];
            $date = $row["date"];
            $time = $row["time"];


            $pdoQuery = $conn->prepare("INSERT INTO reservation (id_reservation ,id_salon,id_worker_user ,id_user ,username,email,duration,price,service_name,date,time) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
            $pdoQuery->execute([$name,$id_salon,$id_worker_user,$id_user,$username,$email,$duration,$price,$service_name,$date,$time]);
        }
    }


    $sql = "DELETE FROM reservation_archived WHERE id_reservation=?";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$name]);

    header("Location:salon_info.php");
}