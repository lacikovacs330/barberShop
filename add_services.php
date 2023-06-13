<?php

include "includes/nav.php";

$conn = connectDatabase($dsn, $pdoOptions);

$realdate = date("Y-m-d", strtotime(" + 1 day"));
$realtime = date("H:i:s", strtotime(" + 2 hour"));

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

            if (isset($_GET["error"]) and $_GET["error"] == 2)
            {
                echo "<div class='error1' style='width: 50%; margin: 1rem auto;'><a>Hibás szolgáltatás név</a></div>";
            }

            if (isset($_GET["error"]) and $_GET["error"] == 3)
            {
                echo "<div class='error1' style='width: 50%; margin: 1rem auto;'><a>Hibás ár</a></div>";
            }

            if (isset($_GET["error"]) and $_GET["error"] == 4)
            {
                echo "<div class='error1' style='width: 50%; margin: 1rem auto;'><a>Hibás időtartam</a></div>";
            }

            if (isset($_GET["error"]) and $_GET["error"] == 5)
            {
                echo "<div class='error1' style='width: 50%; margin: 1rem auto;'><a>Már van ilyen szolgáltatásod</a></div>";
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
              <td>
            <form action="delete_service.php" method="post" onsubmit="return confirm(\'Biztosan törölni szeretnéd ezt a szolgáltatást?\')">

		    <input hidden value="'.$row["id_service"].'" name="id_service" id="id_service" ">

                <input type="submit" style="width: 100%; background-color: #ff0000; border: 0; border-radius: 5px; padding: 8px" value="Törlés" name="delete">
            </form>
        </td>
        <td>
            <form action="modify_service.php" method="post">
			
		    <input hidden value="'.$row["id_service"].'" name="id_service" id="id_service" ">
                <input hidden value="'.$row["service_name"].'" name="service_name" id="service_name" ">
                <input hidden value="'.$row["price"].'" name="price" id="price" ">
                <input hidden value="'.$row["duration"].'" name="duration" id="duration" ">

                <input type="submit" style="width: 100%; background-color: #ffff00; border: 0; border-radius: 5px; padding: 8px" value="Módositás" name="modify">
            </form>
        </td>
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

if (isset($_GET["ok"]) and $_GET["ok"] == 13)
{
    echo "<div class='ok1' style='width: 50%; margin: 1rem auto;'><a>Módositva!</a></div>";
}

if (isset($_GET["error"]) and $_GET["error"] == 11)
{
    echo "<div class='error1' style='width: 50%; margin: 1rem auto;'><a>Töltsön ki mezőt!</a></div>";
}

if (isset($_GET["error"]) and $_GET["error"] == 12)
{
    echo "<div class='error1' style='width: 50%; margin: 1rem auto;'><a>Hibás szolgáltatás!</a></div>";
}

if (isset($_GET["error"]) and $_GET["error"] == 14)
{
    echo "<div class='error1' style='width: 50%; margin: 1rem auto;'><a>Ugyan az a szolgáltatás név!</a></div>";
}

if (isset($_GET["error"]) and $_GET["error"] == 15)
{
    echo "<div class='error1' style='width: 50%; margin: 1rem auto;'><a>Ugyan az az ár</a></div>";
}

if (isset($_GET["error"]) and $_GET["error"] == 16)
{
    echo "<div class='error1' style='width: 50%; margin: 1rem auto;'><a>Ugyan az az időtartam</a></div>";
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
        $hasReservations = false; // Flag to check if there are any reservations

        if ($stmt1->rowCount() > 0) {
            foreach ($results1 as $row1) {
                $id_user = $row1["id_user"];
                $salon_id = $row1["id_salon"];
                $id_reservation = $row1["id_reservation"];
                $id_worker_user = $row1["id_worker_user"];
                $username = $row1["username"];
                $email = $row1["email"];
                $duration = $row1["duration"];
                $price = $row1["price"];
                $service_name = $row1["service_name"];
                $date = $row1["date"];
                $time = $row1["time"];

                $sql2 = "SELECT * FROM users WHERE id_user = '$id_user'";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->execute();

                $results2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                if ($stmt2->rowCount() > 0) {
                    foreach ($results2 as $row2) {
                        $date2 = $row1["date"];
                        if ($realdate < $date2) {
                            $hasReservations = true; // Set flag to true since there is at least one valid reservation
                            ?>
                            <tr>
                                <td><?php echo $row2["username"] ?></td>
                                <td><?php echo $row2["email"] ?></td>
                                <td><?php echo $row1["duration"] ?></td>
                                <td><?php echo $row1["price"] ?></td>
                                <td><?php echo $row1["service_name"] ?></td>
                                <td><?php echo $row1["date"] ?></td>
                                <td><?php echo $row1["time"] ?></td>
                                <td>
                                    <?php echo '<form action="delete_reservation.php" method="post" onsubmit="return confirm(\'Biztosan törölni szeretnéd ezt a foglalást?\')">
                                        <input hidden value="'.$id_reservation.'" name="id_reservation" id="id_reservation" ">
                                        <input hidden value="'.$id_worker_user.'" name="id_worker_user" id="id_worker_user" ">
                                        <input hidden value="'.$id_user.'" name="id_user" id="id_user" ">
                                        <input hidden value="'.$email.'" name="email" id="email" ">
                                        <input hidden value="'.$username.'" name="username" id="username" ">
                                        <input hidden value="'.$salon_id.'" name="id" id="id" ">
                                        <input hidden value="'.$duration.'" name="duration" id="duration" ">
                                        <input hidden value="'.$price.'" name="price" id="price" ">
                                        <input hidden value="'.$service_name.'" name="service_name" id="service_name" ">
                                        <input hidden value="'.$date.'" name="date" id="date" ">
                                        <input hidden value="'.$time.'" name="time" id="time" ">
                                        <input type="submit" style="width: 70%; background-color: #ff0000; border: 0; border-radius: 5px; padding: 8px" value="Lemondás" name="delete12">
                                    </form> '?>
                                </td>
                            </tr>
                        <?php }
                    }
                }
            }
        }

        if (!$hasReservations) {
            echo '<tr><td colspan="8">Nincs foglalás</td></tr>';
        }
        ?>
        </tbody>
    </table>
    <?php
    if (isset($_GET["ok"]) and $_GET["ok"] == 50) {
        echo "<div class='ok1' style='width: 50%; margin: 1rem auto;'><a>Lemondva!</a></div>";
    }
    ?>
</div>

</div>
</body>
</html>

<?php
include "includes/footer.php";
?>


