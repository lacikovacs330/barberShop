<?php
include "includes/nav.php";

if (!isset($_POST["id_worker"]))
{
    header("Location:login.php");
}

if (!isset($_POST["duration"]))
{
    header("Location:login.php");
}

if (!isset($_POST["salon_id"]))
{
    header("Location:login.php");
}

if (!isset($_POST["price"]))
{
    header("Location:login.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
<?php
$conn = connectDatabase($dsn, $pdoOptions);

$id_w = $_GET["id_worker"];
$duration1 = $_GET["duration"];
$id_s = $_GET["salon_id"];
$price = $_GET["price"];

$stmt = $conn->prepare("Select * from workers_hours WHERE id_user = '$id_w'");
$stmt->execute();
$rows = $stmt->fetchAll();

$stmt1 = $conn->prepare("Select * from reservation WHERE id_worker_user = '$id_w'");
$stmt1->execute();
$rows1 = $stmt1->fetchAll();

foreach($rows1 as $row1) {
    $r_date = $row1["date"];

    if ($r_date > date("Y-m-d")) {


        foreach($rows as $row) {

    $id_user123 = $row["id_user"];
    $day123 = $row["day"];
    $date = strtotime($day123);
    $date = date('l', $date);

    $from_hour = $row["from_hour"];
    $to_hour = $row["to_hour"];

    $appointment_date = date('l');


            echo "<br>";
        }
    }
}


/*echo '<a href="appointments.php?day=' . $day123 . '&time=' . $from_hour . '&price=' . $price . '&duration=' . $asd . '&id_user=' . $_SESSION['id_user'] . '&id_salon=' . $id_s . '&id_worker_user=' . $id_w . '">' . $asd . '</a>' . '<br>';*/

/*$from_hour = strtotime($from_hour);
$to_hour = strtotime($to_hour);
$duration12 = $duration1 * 60;

for ($i = $from_hour; $i <= $to_hour; $i+=$duration12)
{
    $asd = date("H:i:s", $i);


     if ($r_date == $day123)
     {
        if ($asd >= $r_time and $asd <= $r_time2 )
        {
        }
        else
        {
        }
     }
     else
     {
     }

    }*/

/*


*/



?>
</body>
</html>
<script>function onlyOne(checkbox) {
        var checkboxes = document.getElementsByName('input')
        checkboxes.forEach((item) => {
            if (item !== checkbox) item.checked = false
        })
    }</script>

<?php
include "includes/footer.php";
?>
