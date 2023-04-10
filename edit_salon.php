<?php
include "includes/config.php";
include "includes/db_config.php";

$conn = connectDatabase($dsn, $pdoOptions);

if (isset($_GET["id"]) && isset($_GET["ban"])) {
    $id_user = $_GET["id"];
    $ban = $_GET["ban"];

    $sql = "UPDATE salons SET ban=:ban WHERE id_user=:id_user";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ban', $ban);
    $stmt->bindParam(':id_user', $id_user);
    $stmt->execute();

    header("location:datatable.php");
}
?>