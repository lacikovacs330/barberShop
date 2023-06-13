<?php
session_start();
include "includes/functions.php";

$time3 = $_SESSION["asd3"];
$date3 = $_SESSION["day3"];

$conn = connectDatabase($dsn, $pdoOptions);

if (isset($_POST["reserv-sb"]) and isset($_POST["email"]) and !empty($_POST["email"]))
{
    $hour = $_POST["hour"];
    $username = $_POST["username"];
    $day = $_POST["day"];
    $price = $_POST["price"];
    $time = $_POST["time"];
    $email = $_POST["email"];
    $_SESSION["email"] = $email;
    $id_w = $_POST["id_w"];
    $id_s = $_POST["id_s"];
    $s_name = $_POST["s_name"];
    $id_user = $_POST["id_u"];
    $token = bin2hex(random_bytes(16));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: salons.php?error=1");
        exit; 
    }

    $pdoQuery = $conn->prepare("INSERT INTO reservation (id_salon,id_worker_user,id_user,username,email,duration,price,service_name,date,time) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $pdoQuery->execute([$id_s,$id_w,$id_user,$username,$email,$time,$price,$s_name,$day,$hour]);

    header("Location:salons.php?r=6");
}
else
{
    header("Location:salons.php?error=1");
}
