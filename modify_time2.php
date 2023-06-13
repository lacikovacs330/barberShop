<?php
include "includes/functions.php";
$conn = connectDatabase($dsn, $pdoOptions);
session_start();

$realdate = date("Y-m-d", strtotime(" + 1 day"));

$id_hour = $_GET["id_hour"];
$salon_id = $_GET["salon_id"];
$day = $_GET["day"];
$from_hour = $_GET["from_hour"];
$to_hour = $_GET["to_hour"];

$isEmpty = true;

if (isset($_POST["sub100"])) {

	if (isset($_POST["date"]) && !empty($_POST["date"])) {
		$date4 = $_POST["date"];

		if ($date4 < $realdate) {
			header("Location:salon_info.php?error=101&id=$salon_id");
			exit;
		}
		else
		{
		$sql = "UPDATE workers_hours SET day = :date4 WHERE id_hour = :id_hour";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':date4', $date4, PDO::PARAM_STR);
		$stmt->bindParam(':id_hour', $id_hour, PDO::PARAM_INT);
		$stmt->execute();
		header("Location:salon_info.php?ok=101&id=$salon_id");
		$isEmpty = false;
		exit;
		}
	}

	if (isset($_POST["time4"]) && !empty($_POST["time4"]) && isset($_POST["time5"]) && !empty($_POST["time5"])) {
		$time4 = $_POST["time4"];
		$time5 = $_POST["time5"];

		if ($time5 < $time4) {
			header("Location:salon_info.php?error=105&id=$salon_id");
			exit;
		}
		else
		{
		$sql = "UPDATE workers_hours SET from_hour = :time4, to_hour = :time5 WHERE id_hour = :id_hour";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':time4', $time4, PDO::PARAM_STR);
		$stmt->bindParam(':time5', $time5, PDO::PARAM_STR);
		$stmt->bindParam(':id_hour', $id_hour, PDO::PARAM_INT);
		$stmt->execute();
		header("Location:salon_info.php?ok=101&id=$salon_id");
		$isEmpty = false;
		exit;
		}
	}

	
}

if ($isEmpty) {
	header("Location:salon_info.php?error=150&id=$salon_id");
	exit;
}
?>
