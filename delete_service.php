<?php

session_start();

include "includes/functions.php";

$conn = connectDatabase($dsn, $pdoOptions);

if (isset($_POST["delete"]))
{
    $name = $_GET["service"];
    echo $name;

    $sql = "DELETE FROM services WHERE id_service=?";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$name]);

    header("Location:add_services.php?ok=2");
}

