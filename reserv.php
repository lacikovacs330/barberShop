<?php

include "includes/functions.php";

$conn = connectDatabase($dsn, $pdoOptions);

if (isset($_POST["reserv-sb"]) and isset($_POST["email"]) and !empty($_POST["email"]))
{
    $hour = $_POST["hour"];
    $username = $_POST["username"];
    $day = $_POST["day"];
    $price = $_POST["price"];
    $time = $_POST["time"];
    $email = $_POST["email"];
    $id_w = $_POST["id_w"];
    $id_s = $_POST["id_s"];
    $id_user = $_POST["id_u"];

    $pdoQuery = $conn->prepare("INSERT INTO reservation (id_salon,id_worker_user,id_user,username,email,duration,price,date,time) VALUES (?,?,?,?,?,?,?,?,?)");
    $pdoQuery->execute([$id_s,$id_w,$id_user,$username,$email,$time,$price,$day,$hour]);

    header("Location:salons.php?r=6");

}
else
{
   header("Location:salons.php?error=1");
}
