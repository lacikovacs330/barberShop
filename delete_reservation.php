<?php

session_start();

include "includes/functions.php";

$conn = connectDatabase($dsn, $pdoOptions);

if (isset($_POST["delete"]))
{
    $salon = $_GET["salon"];
    $name = $_GET["service"];

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


            $pdoQuery = $conn->prepare("INSERT INTO reservation_deleted (id_reservation ,id_salon,id_worker_user ,id_user ,username,email,duration,price,service_name,date,time) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
            $pdoQuery->execute([$name,$id_salon,$id_worker_user,$id_user,$username,$email,$duration,$price,$service_name,$date,$time]);
        }
    }



             $sql = "DELETE FROM reservation WHERE id_reservation=?";
             $stmt= $conn->prepare($sql);
             $stmt->execute([$name]);

    header("Location:reservation.php?ok=$salon");


}

if (isset($_POST["delete1"]))
{
    $salon = $_POST["id"];
    $id_reservation = $_POST["id_reservation"];

    $sql = "SELECT * FROM reservation WHERE id_reservation = '$id_reservation'";
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


            $pdoQuery = $conn->prepare("INSERT INTO reservation_deleted (id_reservation ,id_salon,id_worker_user ,id_user ,username,email,duration,price,service_name,date,time) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
            $pdoQuery->execute([$id_reservation,$id_salon,$id_worker_user,$id_user,$username,$email,$duration,$price,$service_name,$date,$time]);
        }
    }

    $sql = "DELETE FROM reservation WHERE id_reservation=?";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$id_reservation]);
    header("Location:salon_info.php?ok=11&id=$salon");
}


