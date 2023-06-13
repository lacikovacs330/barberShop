<?php
include "includes/functions.php";
$conn = connectDatabase($dsn, $pdoOptions);

    $selectedWorkerId = $_POST["workers"];
    echo $selectedWorkerId;

if (isset($_POST["add_w"]) && isset($_POST["days"]) && !empty($_POST["days"]) && isset($_POST["time1"]) && !empty($_POST["time1"]) && isset($_POST["time2"]) && !empty($_POST["time2"]) && isset($_POST["workers"]) && !empty($_POST["workers"])) {
    $salon_id = $_POST["salons"];
    $workers = $_POST["workers"];
    $days = $_POST["days"];
    $time1 = $_POST["time1"];
    $time2 = $_POST["time2"];
	
    if ($_POST["workers"] === "Válasszon munkást") {
    header("Location:salon_info.php?error=5&id=$salon_id");
	exit;
	}
    
	
    $realdate = date("Y-m-d", strtotime(" + 1 day"));

	if (isset($_POST["days"]) && !empty($_POST["days"])) {
		$days = $_POST["days"];

		if ($days < $realdate) {
			header("Location:salon_info.php?error=201&id=$salon_id");
			exit;
		}
	}

	if (isset($_POST["time1"]) && !empty($_POST["time1"]) && isset($_POST["time2"]) && !empty($_POST["time2"])) {
		$time1 = $_POST["time1"];
		$time2 = $_POST["time2"];

		if ($time2 < $time1) {
			header("Location:salon_info.php?error=205&id=$salon_id");
			exit;
		}
	}
   	 

        $pdoQuery = $conn->prepare("INSERT INTO workers_hours (id_user, salon_id, day, from_hour, to_hour) VALUES (?, ?, ?, ?, ?)");
        $pdoQuery->execute([$selectedWorkerId, $salon_id, $days, $time1, $time2]);

    header("Location:salon_info.php?r=6");
} else {
    header("Location:salon_info.php?error=5");
}
?>
