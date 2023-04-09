<?php
include "../includes/config.php";
include "../includes/db_config.php";

$conn = connectDatabase($dsn, $pdoOptions);

if (isset($_GET["id"]) && isset($_GET["status"])) {
    $id_user = $_GET["id"];
    $status = $_GET["status"];

    $sql = "UPDATE users SET status=:status WHERE id_user=:id_user";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id_user', $id_user);
    $stmt->execute();

    header("location:datatable.php");
}
?>