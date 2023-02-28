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
