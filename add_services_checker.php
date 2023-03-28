<?php

session_start();

include "includes/functions.php";

$conn = connectDatabase($dsn, $pdoOptions);

if (isset($_POST["add"]) and isset($_POST["asd"]) and !empty($_POST["asd"]) and isset($_POST["asd1"]) and !empty($_POST["asd1"]) and isset($_POST["asd2"]) and !empty($_POST["asd2"]) )
{
    $name = $_POST["asd"];
    $price = $_POST["asd1"];
    $duration = $_POST["asd2"];

    $stmt = $conn->query("SELECT * FROM workers WHERE id_user = '$_SESSION[id_user]'");
    if ($row = $stmt->fetch()) {
       $id  = $row["id_user"];

        $pdoQuery = $conn->prepare("INSERT INTO services (id_user,service_name,price,duration) VALUES (?,?,?,?)");
        $pdoQuery->execute([$id,$name,$price,$duration]);

       header("Location:add_services.php?ok=1");
    }

}
else
{
    header("Location:add_services.php?error=1");
}
