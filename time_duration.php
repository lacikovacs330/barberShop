<?php

include "includes/nav.php";


$conn = connectDatabase($dsn, $pdoOptions);

$id_user = $_POST["id_user"];

$_SESSION["id_user1"] = $id_user;
?>
<link rel="stylesheet" href="css/style.css">

<div class="services">

<?php
$stmt = $conn->prepare("Select * from services WHERE id_user = '$id_user'");
$stmt->execute();
$rows = $stmt->fetchAll();

if ($stmt->rowCount() > 0) {
    foreach ($rows as $row) {
        $duration = $row["duration"];
        $price = $row["price"];
        $s_name = $row["service_name"];
        echo '<form method="post" action="time_duration_checker_2.php" id="form2">';
        echo '<div class="services_center">';
        echo '<div class="services_name">';
        echo '<input style="padding:0px; width:20%; border:0px; outline:0" type="text" readonly value="' . $row["service_name"] . '" style="border:0px solid black" name="service_name" id="service_name">';
        echo '</div>';
        echo '<div class="services_min">';
        echo '<input style="padding:0px; width:20%; border:0px; outline:0" type="text" readonly value="' . $row["duration"] . '" style="border:0px solid black" name="duration1" id="duration1"> PERC';
        echo '</div>';
        echo '<div class="services_price">';
        echo '<input style="padding:0px; width:20%; border:0px; outline:0" type="text" readonly value="' . $row["price"] . '" style="border:0px solid black" name="price" id="price"> FT';
        echo '</div>';
        if (isset($_SESSION["id_user"])) {
            echo '<button id="select" name="select" style="border-radius: 3px; border: 0; background-color: #9E8A78; padding: 7px; justify-content: right">Választás';
        } else {
            echo "<a style='width: 57%; color: #ff0000'>Jelentkezz be a foglaláshoz!</a>";
        }
        echo '</div>';
        echo '</form>';
    }
}
else
{
    echo "<div style='text-align: center; justify-content: center; width: 100%;'>";
    echo "<h1>Ehhez a munkáshoz nincs elérhető szolgáltatás!</h1>";
    echo "</div>";
}
?>
</div>

<?php include "includes/footer.php"; ?>

