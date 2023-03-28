<?php

include "includes/functions.php";
$conn = connectDatabase($dsn, $pdoOptions);
session_start();

if (isset($_POST["ban"]))
{
    $id_user = $_GET["id_user"];

    $sql = "UPDATE users SET status = 0 WHERE id_user = :id_user";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_user',$id_user , PDO::PARAM_STR);
    $stmt->execute();
    header("Location:add_salon.php");
}

if (isset($_POST["unban"]))
{
    $id_user = $_GET["id_user"];

    $sql = "UPDATE users SET status = 1 WHERE id_user = :id_user";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_user',$id_user , PDO::PARAM_STR);
    $stmt->execute();
    header("Location:add_salon.php");
}

if (isset($_POST["ban_salon"]))
{
    $id_salon = $_GET["id_salon"];

    $sql = "UPDATE salons SET ban = 1 WHERE id_salon = :id_salon";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_salon',$id_salon , PDO::PARAM_STR);
    $stmt->execute();
    header("Location:add_salon.php");
}

if (isset($_POST["unban_salon"]))
{
    $id_salon = $_GET["id_salon"];

    $sql = "UPDATE salons SET ban = 0 WHERE id_salon = :id_salon";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_salon',$id_salon , PDO::PARAM_STR);
    $stmt->execute();
    header("Location:add_salon.php");
}



