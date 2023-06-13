<?php

include "includes/functions.php";
$conn = connectDatabase($dsn, $pdoOptions);
session_start();

$realdate = date("Y-m-d", strtotime(" + 1 day"));
$realtime = date("H:i:s", strtotime(" + 2 hour"));

$reservation = $_GET["reservation"];
$salon = $_GET["salon"];
$duration = $_GET["duration"];
$price = $_GET["price"];
$service_name = $_GET["service_name"];
$date = $_GET["date"];
$time = $_GET["time"];

if (isset($_POST["sub"])) {
    $isEmpty = true;

    if (isset($_POST["s_name2"]) && !empty($_POST["s_name2"])) {
        $s_name1 = $_POST["s_name2"];

        if (!preg_match('/^[a-zA-ZáéíóöőúüűÁÉÍÓÖŐÚÜŰ\s]+$/', $s_name1)) {
            header("Location:salon_info.php?error=12");
            exit;
        } else {
            $sql = "UPDATE reservation SET service_name = '$s_name1' WHERE id_reservation = :reservation";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':reservation', $reservation, PDO::PARAM_STR);
            $stmt->execute();
            $isEmpty = false;
        }
    }

    if (isset($_POST["price2"]) && !empty($_POST["price2"])) {
        $s_name1 = $_POST["price2"];

        if (!is_numeric($s_name1) or $s_name1 < 0) {
            header("Location:salon_info.php?error=12");
            exit;
        } else {
            $sql = "UPDATE reservation SET price = '$s_name1' WHERE id_reservation = :reservation";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':reservation', $reservation, PDO::PARAM_STR);
            $stmt->execute();
            $isEmpty = false;
        }
    }

    if (isset($_POST["date2"]) && !empty($_POST["date2"])) {
        $s_name1 = $_POST["date2"];

	  if($s_name1 < $realdate)
	  {
		header("Location:salon_info.php?error=12");
        }
	  else
        {
        $sql = "UPDATE reservation SET date = '$s_name1' WHERE id_reservation = :reservation";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':reservation', $reservation, PDO::PARAM_STR);
        $stmt->execute();
        $isEmpty = false;
    	  }
	}

    if (isset($_POST["time2"]) && !empty($_POST["time2"])) {
        $s_name1 = $_POST["time2"];
	  $s_name2 = $_POST["date2"];
        header("Location:salon_info.php?ok=12&id=$salon");
	  
        if($s_name2 === $realdate && $s_name1 < $realtime)
	  {
		header("Location:salon_info.php?error=12");
	  }
	  else
	  {
        $sql = "UPDATE reservation SET time = '$s_name1' WHERE id_reservation = :reservation";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':reservation', $reservation, PDO::PARAM_STR);
        $stmt->execute();
        $isEmpty = false;
	  }
    }

    if (isset($_POST["duration2"]) && !empty($_POST["duration2"])) {
        $s_name1 = $_POST["duration2"];

        if (!is_numeric($s_name1) or $s_name1 < 0) {
            header("Location:salon_info.php?error=12");
            exit;
        } else {
            $sql = "UPDATE reservation SET duration = '$s_name1' WHERE id_reservation = :reservation";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':reservation', $reservation, PDO::PARAM_STR);
            $stmt->execute();
            $isEmpty = false;
        }
    }

    if ($isEmpty) {
        header("Location:salon_info.php?error=13");
        exit;
    }

    header("Location:salon_info.php?ok=12&id=$salon");
} else {
    header("Location:salon_info.php");
}

$id_hour = $_GET["id_hour"];
$salon_id = $_GET["salon_id"];
$day = $_GET["day"];
$from_hour = $_GET["from_hour"];
$to_hour = $_GET["to_hour"];




