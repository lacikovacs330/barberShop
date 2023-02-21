<?php

include "includes/nav.php";


$conn = connectDatabase($dsn, $pdoOptions);
if (isset($_GET["id"])){
    $w_id = $_GET["id"];
    $s_id = $_GET["salon_id"];
}
else
{
    header("Location:salons.php");
}


?>
<link rel="stylesheet" href="css/style.css">

<div class="services">

<?php
$stmt = $conn->prepare("Select * from services WHERE id_user = '$w_id'");
$stmt->execute();
$rows = $stmt->fetchAll();

foreach($rows as $row)
{
    $duration = $row["duration"];
    $price = $row["price"];
    echo '<form method="post" action="time_duration_checker_2.php?id_worker='.$w_id.'&duration='.$duration.'&salon_id='.$s_id.'&price='.$price.'" id="form2">';
    echo '<div class="services_center">';
    echo '<div class="services_name">';
    echo '<a>'. $row["service_name"] . '</a>';
    echo '</div>';
    echo '<div class="services_min">';
    echo '<a>'. $row["duration"] . " perc" .'</a>';
    echo '</div>';
    echo '<div class="services_price">';
    echo '<a>'. $row["price"] . "FT" .'</a>';
    echo '</div>';
    echo '<button id="select" name="select" style="border-radius: 3px; border: 0; background-color: #9E8A78; padding: 7px; justify-content: right">Választás';
    echo '</div>';
    echo '</form>';
}
?>
</div>

<?php include "includes/footer.php"; ?>

