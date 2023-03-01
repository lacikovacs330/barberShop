<?php

session_start();

include "includes/functions.php";

$conn = connectDatabase($dsn, $pdoOptions);

if (isset($_POST["delete"]))
{
    $name = $_GET["service"];
    echo $name;

    $sql = "DELETE FROM reservation WHERE id_reservation=?";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$name]);

    header("Location:reservation.php?ok=2");
}

if (isset($_POST["delete1"]))
{
    $salon = $_GET["salon"];
    $id_reservation = $_GET["reservation"];

    $sql = "DELETE FROM reservation WHERE id_reservation=?";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$id_reservation]);
    header("Location:salon_info.php?ok=11&id=$salon");
}


