<?php
include 'includes/nav.php';

$conn = connectDatabase($dsn, $pdoOptions);
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

<style>

    .add-salon .table
    {
        width: 80%;
        text-align: center;
        justify-content: center;
        margin: 2rem auto;
    }

    @media only screen and (max-width: 700px) {


        th{
            font-size: 10px;
        }

        td{
            font-size: 10px;
            padding: 0 !important;
        }

        form td{
            width: 50%;
            font-size: 10px;
        }

        table.table{
            margin: 0;
        }

        th{
            padding: 0 !important;
        }

        input{
            margin: 0 !important;
        }

        .add-salon{
            text-align: center;
            justify-content: center;
            align-items: center;
        }
    }

</style>
<body>

<?php



$sql = "SELECT * FROM reservation WHERE id_user = '$_SESSION[id_user]'";
$stmt = $conn->prepare($sql);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);



$sql1 = "SELECT * FROM users";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();

$results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
?>

<h1 style="text-align: center">Foglalásaim</h1>
<hr>


<table class="table" style="width: 80%; text-align: center; justify-content: center; margin: 2rem auto;">
    <thead class="thead" style="background-color: #9E8A78;">
    <tr>
        <th scope="col">Időtartam</th>
        <th scope="col">Ár</th>
        <th scope="col">Szolgáltatás név</th>
        <th scope="col">Dátum</th>
        <th scope="col">Idő</th>
        <th scope="col">Kinél</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    <?php
    if ($stmt->rowCount() > 0) {
        foreach ($results as $row) {
            ?>
    <tr>
        <td><?php echo $row["duration"] ." ". "Perc"?></td>
        <td><?php echo $row["price"] . " " . "FT"?></td>
        <td><?php echo $row["service_name"]?></td>
        <td><?php echo $row["date"]?></td>
        <td><?php echo $row["time"]?></td>
        <td><?php if ($stmt1->rowCount() > 0) {
                     foreach ($results1 as $row1) {

                   if ($row["id_worker_user"] == $row1["id_user"])
                       {
                           echo $row1["firstname"] ." ". $row1["lastname"];
                       }
                }
            }
            ?></td>
        <?php echo '<td><form action="delete_reservation.php?service='.$row["id_reservation"].'" method="post"><input type="submit" style="width: 70%; background-color: #ff0000; border: 0; border-radius: 5px; padding: 8px" value="Lemondás" name="delete"></form></td>' ?>
    </tr>
    <?php } ?>
    </tbody>
    <?php
    }
    else
    {
        echo "<h1 style='text-align: center'>Nincs megjelenithető foglalás</h1>";
    }
    ?>
</table>

<?php
if (isset($_GET["ok"]) and $_GET["ok"] == 2)
{
echo "<div class='ok1' style='width: 50%; margin: 1rem auto;'><a>Lemondva!</a></div>";
}
?>

</body>
</html>


<?php
include 'includes/footer.php';
?>
