<?php

include "includes/nav.php";

$conn = connectDatabase($dsn, $pdoOptions);

if (isset($_SESSION["id_user"]))
{
    $sql = "SELECT * FROM users WHERE id_user = '$_SESSION[id_user]'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
        foreach ($results as $row) {
            if ($row["role"]!="worker")
            {
                header("Location:index.php");
            }
        }
    }
}
else
{
    header("Location:index.php");
}

$sql1 = "SELECT * FROM reservation WHERE id_worker_user = '$_SESSION[id_user]'";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();

$results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<style>

    .add-salon .table
    {
        width: 80%;
        text-align: center;
        justify-content: center;
        margin: 2rem auto;
    }

    @media only screen and (max-width: 600px) {


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

<hr>
<h1 style="justify-content: center; text-align: center">Szolgáltatás hozzáadása</h1>
<form action="add_services_checker.php" method="post">
    <script src="js/script.js"></script>
<div class="add-salon">
    <div class="row pt-3 gifts" style="width: 100%; margin: 0; justify-content: center; text-align: center">
        <div class="inputs" style="width: 100%; justify-content: center">
            <input type="text" class="form-control" id="asd" name="asd" style="width: 50%" placeholder="Szolgáltatás...">
            <input type="text" class="form-control" id="asd1" name="asd1" style="width: 50%" placeholder="Ár...">
            <input type="text" class="form-control" id="asd2" name="asd2" style="width: 50%" placeholder="Időtartam...">
        </div>
    </div>
    <div class="center-button" style="justify-content: center; width: 100%; text-align: center">

        <?php
        if (isset($_GET["error"]) and $_GET["error"] == 1)
        {
            echo "<div class='error1' style='width: 50%; margin: 1rem auto;'><a>Töltsön ki minden mezőt!</a></div>";
        }

        if (isset($_GET["ok"]) and $_GET["ok"] == 1)
        {
            echo "<div class='ok1' style='width: 50%; margin: 1rem auto;'><a>Hozzáadva!</a></div>";
        }
        ?>

       <input type="submit" value="Hozzáadás" id="add" name="add" style="width: 20%; justify-content: center">
    </div>


    <h1 style="justify-content: center; text-align: center">Saját szolgáltatásaim</h1>
</form>
    <hr>

    <?php
    $sql = "SELECT * FROM services WHERE id_user = '$_SESSION[id_user]'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo ' <table class="table" style="width: 50%; margin: 2rem auto;">
  <thead>
    <tr>
      <th scope="col" style="width: 40%">Név</th>
      <th scope="col">Ár</th>
      <th scope="col">Időtartam</th>
    </tr>
  </thead>';

    if ($stmt->rowCount() > 0) {
        foreach ($results as $row) {

        $_SESSION["servicename"] = $row["service_name"];

            echo '<table class="table"  style="width: 50%; margin: 2rem auto;">
  <tbody>
    <tr>
      <td style="width: 40%; padding: 0; vertical-align: center;">' . $row["service_name"] . '</td>
      <td style="width: 20%; padding: 0; vertical-align: center;">' . $row["price"] . " .Ft" . '</td>
      <td style="width: 20%; padding: 0; vertical-align: center;">' . $row["duration"] . " perc" . '</td>
      <td><form action="delete_service.php?service='.$row["id_service"].'" method="post"><input type="submit" style="width: 100%; background-color: #ff0000; border: 0; border-radius: 5px; padding: 8px" value="Törlés" name="delete"></form></td>
      <td><form action="modify_service.php?service='.$row["id_service"].'&s_name='.$row["service_name"].'&price='.$row["price"].'&duration='.$row["duration"].'" method="post"><input type="submit" style="width: 100%; background-color: #ffff00; border: 0; border-radius: 5px; padding: 8px" value="Módositás" name="modify"></form></td>
    </tr>
  </tbody>
</table>';
        }
    }
    ?>
<?php
if (isset($_GET["ok"]) and $_GET["ok"] == 2)
{
    echo "<div class='ok1' style='width: 50%; margin: 1rem auto;'><a>Törölve!</a></div>";
}

if (isset($_GET["ok"]) and $_GET["ok"] == 9)
{
    echo "<div class='ok1' style='width: 50%; margin: 1rem auto;'><a>Megváltoztatva!</a></div>";
}
?>

<hr>
<h1 style="justify-content: center; text-align: center">Foglalások</h1>
<div class="add-salon">
    <table class="table" style="width: 80%; text-align: center; justify-content: center; margin: 2rem auto;">
        <thead class="thead" style="background-color: #9E8A78;">
        <tr>
            <th scope="col">Foglaló neve</th>
            <th scope="col">E-mail</th>
            <th scope="col">Időtartam</th>
            <th scope="col">Ár</th>
            <th scope="col">Szolgáltatás</th>
            <th scope="col">Mikor</th>
            <th scope="col">Idő</th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
        <?php
        if ($stmt1->rowCount() > 0) {
            foreach ($results1 as $row1) {
                $id_user = $row1["id_user"];

                $sql2 = "SELECT * FROM users WHERE id_user = '$id_user'";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->execute();

                $results2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                     if ($stmt2->rowCount() > 0) {
                        foreach ($results2 as $row2) {

                ?>
                <tr>
                <td><?php echo $row2["username"] ?></td>
                <td><?php echo $row2["email"] ?></td>
                <td><?php echo $row1["duration"] ?></td>
                <td><?php echo $row1["price"] ?></td>
                <td><?php echo $row1["service_name"] ?></td>
                <td><?php echo $row1["date"] ?></td>
                <td><?php echo $row1["time"] ?></td>
                <?php echo '<td><form action="#" method="post"><input type="submit" style="width: 70%; background-color: #ff0000; border: 0; border-radius: 5px; padding: 8px" value="Lemondás" name="delete12"></form></td>';?>

                            <?php
                            if (isset($_POST["delete12"]))
                            {
                                $id_reservation = $row1["id_reservation"];
                                $id_salon = $row1["id_salon"];
                                $id_worker_user = $row1["id_worker_user"];
                                $id_user1 = $row2["id_user"];
                                $username = $row2["username"];
                                $email = $row2["email"];
                                $duration = $row1["duration"];
                                $price = $row1["price"];
                                $service_name = $row1["service_name"];
                                $date = $row1["date"];
                                $time = $row1["time"];
                                $sql = "DELETE FROM reservation WHERE id_reservation=?";
                                $stmt= $conn->prepare($sql);
                                $stmt->execute([$id_reservation]);

                                $pdoQuery = $conn->prepare("INSERT INTO reservation_deleted (id_reservation ,id_salon,id_worker_user ,id_user ,username,email,duration,price,service_name,date,time) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
                                $pdoQuery->execute([$id_reservation,$id_salon,$id_worker_user,$id_user1,$username,$email,$duration,$price,$service_name,$date,$time]);

                            }
                            ?>


                        <?php } ?>
            <?php } ?>
            </tr>

        <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>
</div>
</body>
</html>

<?php


?>

<?php
include "includes/footer.php";
?>


