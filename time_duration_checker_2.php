<?php
include "includes/nav.php";

$conn = connectDatabase($dsn, $pdoOptions);

$id_w = $_GET["id_worker"];
$duration1 = $_GET["duration"];
$id_s = $_GET["salon_id"];
$price = $_GET["price"];

$stmt = $conn->prepare("Select * from workers_hours WHERE id_user = '$id_w'");
$stmt->execute();
$rows = $stmt->fetchAll();




?>


<?php
echo "<form action='appointments.php' method='post' style='text-align: center'>";
foreach($rows as $row) {
    $day = $row['day'];
    $day_date = date("l", strtotime($day));
    switch ($day_date) {
        case 'Monday':
            echo "<h2 style='text-align: center'>Hétfő - $day</h2>";
            break;
        case 'Tuesday':
            echo "<h2 style='text-align: center'>Kedd - $day</h2>";
            break;
        case 'Wednesday':
            echo "<h2 style='text-align: center'>Szerda - $day</h2>";
            break;
        case 'Thursday':
            echo "<h2 style='text-align: center'>Csütörtök - $day</h2>";
            break;
        case 'Friday':
            echo "<h2 style='text-align: center'>Péntek - $day</h2>";
            break;
        case 'Saturday':
            echo "<h2 style='text-align: center'>Szombat - $day</h2>";
            break;
        case 'Sunday':
            echo "<h2 style='text-align: center'>Vasárnap - $day</h2>";
            break;
    }


    if ($day > date("Y-m-d")) {
        $from_hour = $row["from_hour"];
        $to_hour = $row["to_hour"];

        $from_hour = strtotime($from_hour);
        $to_hour = strtotime($to_hour);
        $duration12 = $duration1 * 60;

        for ($i = $from_hour; $i <= $to_hour; $i += $duration12) {
            $asd = date("H:i:s", $i + $duration12);
            $stmt1 = $conn->prepare("Select * from reservation WHERE id_worker_user = '$id_w' AND date = '$day'");
            $stmt1->execute();
            $rows1 = $stmt1->fetchAll();
            foreach($rows1 as $row1) {
                $r_time1 = $row1["time"];
                $r_time = strtotime($r_time1);
                $r_duration = $row1["duration"];
                $r_duration2 = $r_duration * 60;
                $asd2 = date("H:i:s", $r_time + $r_duration2);
                $r_time2 = date("H:i:s", $r_time);

                if ($asd >= $r_time2 AND $asd <= $asd2)
                {
                    $asd = "";
                }

            }
            echo '<a class="asd-text" href="appointments.php?time=' . $asd . '&day=' . $day . '&price=' . $price . '&duration=' . $duration1 . '&username=' . $_SESSION["un"] . '&id_worker_user=' . $id_w . '&id_salon=' . $id_s . '&id_user=' . $_SESSION["id_user"] . '">' . $asd . '</a>' . "<br>";

        }
    }


    echo "<hr>";
    echo '</div>';
    echo '</div>';
    echo "<form>";
}
?>

<?php
include "includes/footer.php";
?>
