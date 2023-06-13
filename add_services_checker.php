<?php

session_start();

include "includes/functions.php";

$conn = connectDatabase($dsn, $pdoOptions);

if (isset($_POST["add"]) && isset($_POST["asd"]) && !empty($_POST["asd"]) && isset($_POST["asd1"]) && !empty($_POST["asd1"]) && isset($_POST["asd2"]) && !empty($_POST["asd2"]))
{
    $name = $_POST["asd"];
    $price = $_POST["asd1"];
    $duration = $_POST["asd2"];

    if (!is_numeric($price) || intval($price) != $price) {
        header("Location: add_services.php?error=3");
        exit;
    }

    if (preg_match('/^[a-zA-ZáéíóöőúüűÁÉÍÓÖŐÚÜŰ]+$/', $name) === 0) {
        header("Location: add_services.php?error=2");
        exit;
    }

    if (!is_numeric($duration)) {
        header("Location: add_services.php?error=4");
        exit;
    }

    
    $stmt = $conn->prepare("SELECT id_service FROM services WHERE service_name = :name AND id_user = :id_user");
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':id_user',$_SESSION["id_user"],PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        header("Location: add_services.php?error=5");
        exit;
    }

    $stmt = $conn->query("SELECT * FROM workers WHERE id_user = '$_SESSION[id_user]'");
    if ($row = $stmt->fetch()) {
        $id = $row["id_user"];

        $pdoQuery = $conn->prepare("INSERT INTO services (id_user, service_name, price, duration) VALUES (?,?,?,?)");
        $pdoQuery->execute([$id, $name, $price, $duration]);

        header("Location: add_services.php?ok=1");
    }
} else {
    header("Location: add_services.php?error=1");
}
