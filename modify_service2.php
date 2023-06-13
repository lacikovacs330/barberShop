<?php

include "includes/functions.php";
$conn = connectDatabase($dsn, $pdoOptions);
session_start();

$isEmpty = true;

if (isset($_POST["sub"])) {

    if (isset($_POST["s_name1"]) && !empty($_POST["s_name1"])) {
        $s_name = $_GET["s_name"];
        $s_name1 = $_POST["s_name1"];
        $service = $_GET["service"];

        if (!preg_match('/^[a-zA-ZáéíóöőúüűÁÉÍÓÖŐÚÜŰ\s]+$/', $s_name1)) {
            header("Location: add_services.php?error=12");
            exit;
        }

        if ($s_name1 === $s_name)
        {
            header("Location: add_services.php?error=14");
        }
        else
        {
            $sql = "UPDATE services SET service_name = :s_name1 WHERE id_service = :service";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':s_name1', $s_name1, PDO::PARAM_STR);
            $stmt->bindParam(':service', $service, PDO::PARAM_INT);
            $stmt->execute();

            $sql = "UPDATE reservation SET service_name = :s_name1 WHERE service_name = :s_name AND id_worker_user = :id_user";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':s_name1', $s_name1, PDO::PARAM_STR);
            $stmt->bindParam(':s_name', $s_name, PDO::PARAM_STR);
            $stmt->bindParam(':id_user', $_SESSION["id_user1"], PDO::PARAM_STR);
            $stmt->execute();
		header("Location: add_services.php?ok=13");
            
        }
	$isEmpty = false;	

    }

    if (isset($_POST["price1"]) && !empty($_POST["price1"])) {
        $price = $_GET["price"];
        $price1 = $_POST["price1"];
        $service = $_GET["service"];

        if (!is_numeric($price1)) {
            header("Location: add_services.php?error=2");
            exit;
        }

        if ($price1 === $price or $price1 < 0)
        {
            header("Location: add_services.php?error=15");
        }
        else
        {
            $sql = "UPDATE services SET price = :price1 WHERE id_service = :service";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':price1', $price1, PDO::PARAM_STR);
            $stmt->bindParam(':service', $service, PDO::PARAM_INT);
            $stmt->execute();

            $sql = "UPDATE reservation SET price = :price1 WHERE price = :price AND id_worker_user = :id_user";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':price1', $price1, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price, PDO::PARAM_STR);
            $stmt->bindParam(':id_user', $_SESSION["id_user1"], PDO::PARAM_STR);
            $stmt->execute();
		header("Location: add_services.php?ok=13");
           
        }

 $isEmpty = false;
    }

    if (isset($_POST["duration1"]) && !empty($_POST["duration1"])) {
        $duration = $_GET["duration"];
        $duration1 = $_POST["duration1"];
        $service = $_GET["service"];

        if (!is_numeric($duration1) or $duration1 < 0) {
            header("Location: add_services.php?error=16");
            exit;
        }

        if ($duration1 === $duration)
        {
            header("Location: add_services.php?error=16");
        }
        else
        {
            $sql = "UPDATE services SET duration = :duration1 WHERE id_service = :service";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':duration1', $duration1, PDO::PARAM_STR);
            $stmt->bindParam(':service', $service, PDO::PARAM_INT);
            $stmt->execute();
		header("Location: add_services.php?ok=13");
            
        }
	$isEmpty = false;
    }
}
else
{
	header("Location: add_services.php");
}
if ($isEmpty) {
    header("Location: add_services.php?error=11");
}
