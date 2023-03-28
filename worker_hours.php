<?php
include "includes/functions.php";
$conn = connectDatabase($dsn, $pdoOptions);


if (isset($_POST["add_w"]) and isset($_POST["days"]) and !empty($_POST["days"]) and isset($_POST["time1"]) and !empty($_POST["time1"]) and isset($_POST["time2"]) and !empty($_POST["time2"]))
{

    $workers = $_POST["workers"];
    $days = $_POST["days"];
    $time1 = $_POST["time1"];
    $time2 = $_POST["time2"];

    $stmt = $conn->query("SELECT * FROM workers WHERE firstname = '$workers'");
    if ($row = $stmt->fetch()) {
        $id = $row["id_user"];

        $pdoQuery = $conn->prepare("INSERT INTO workers_hours (id_user,day,from_hour,to_hour) VALUES (?,?,?,?)");
        $pdoQuery->execute([$id, $days, $time1,$time2]);
    }
        header("Location:salon_info.php?r=6");
}
else
{
        header("Location:salon_info.php?error=5");
}
