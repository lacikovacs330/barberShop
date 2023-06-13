<?php
include "includes/nav.php";

if (!isset($_POST["duration1"]))
{
    header("Location:login.php");
}

if (!isset($_POST["price"]))
{
    header("Location:login.php");
}

if (!isset($_POST["service_name"]))
{
    header("Location:login.php");
}

$conn = connectDatabase($dsn, $pdoOptions);

$realtime = date("H:i:s", strtotime(" + 2 hour"));

$stmt = $conn->prepare("Select * from workers_hours WHERE id_user = '$_SESSION[id_user1]' ORDER BY day");
$stmt->execute();
$rows = $stmt->fetchAll();
?>


<?php

$found_valid_date = false;

if ($stmt->rowCount() > 0) {
foreach($rows as $row) {

    $day = $row['day'];
    $_SESSION["day"] = $day;
    $day_date = date("l", strtotime($day));

    if ($day >= date("Y-m-d")) {
	$found_valid_date = true;

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

        $from_hour = $row["from_hour"];
        $to_hour = $row["to_hour"];

        $duration1 = $_POST["duration1"];
        $price = $_POST["price"];
        $service_name = $_POST["service_name"];
        $_SESSION["duration1"] = $duration1;
        $_SESSION["price1"] = $price;
        $_SESSION["service_name1"] = $service_name;

        $from_hour = strtotime($from_hour);
        $to_hour = strtotime($to_hour);
        $duration12 = $duration1 * 60;


        for ($i = $from_hour; $i <= $to_hour; $i += $duration12) {
            $asd = date("H:i:s", $i + $duration12);
            $stmt1 = $conn->prepare("Select * from reservation WHERE id_worker_user = '$_SESSION[id_user1]' AND date = '$day'");
            $stmt1->execute();
            $rows1 = $stmt1->fetchAll();
            foreach ($rows1 as $row1) {
                $r_time1 = $row1["time"];
                $r_time = strtotime($r_time1);
                $r_duration = $row1["duration"];
                $r_duration2 = $r_duration * 60;
                $asd2 = date("H:i:s", $r_time + $r_duration2);
                $r_time2 = date("H:i:s", $r_time);
                $asd3 = date("H:i:s", $r_time - $r_duration2);
	
		    		if ($asd < $realtime and $day === date("Y-m-d")){
                    	$asd = "";
            		}

               		 if ($asd > $asd3 and $asd < $asd2) {
                    	 $asd = "";
                         }
            }
            echo "<form method='post' action='appointments.php' style='text-align: center'>
            <button style='border: 0px; background-color: white; padding: 5px' type='submit' name='asd' id='asd' value='$asd'>$asd</button>
            <input type='hidden' value='$day' name='day' id='day'>
            </form>";
        }
    }
    echo "<hr>";
    echo '</div>';
    echo '</div>';
}
}
if (!$found_valid_date) {
    echo "<div style='text-align: center; justify-content: center; width: 100%;'>";
    echo "<h1>Nincs megjeleníthető időpont</h1>";
    echo "</div>";
}
?>

<?php
include "includes/footer.php";
?>