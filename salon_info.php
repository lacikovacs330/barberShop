<?php

include "includes/nav.php";

$d = date("Y-m-d");

$conn = connectDatabase($dsn, $pdoOptions);



$salon_id = $_SESSION["id"];

$sql = "SELECT * FROM workers WHERE id_salon = '$salon_id'";
$stmt = $conn->prepare($sql);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM reservation WHERE id_salon = '$salon_id'";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute();

$results2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$sql4 = "SELECT * FROM reservation_deleted WHERE id_salon = '$salon_id'";
$stmt4 = $conn->prepare($sql4);
$stmt4->execute();

$results4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);

$sql5 = "SELECT * FROM reservation_archived WHERE id_salon = '$salon_id'";
$stmt5 = $conn->prepare($sql5);
$stmt5->execute();

$results5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);

$sql1 = "SELECT * FROM users";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();

$results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$sql9 = "SELECT * FROM salons WHERE id_salon = '$salon_id'";
$stmt9 = $conn->prepare($sql9);
$stmt9->execute();

$results9 = $stmt9->fetchAll(PDO::FETCH_ASSOC);

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

        @media only screen and (max-width: 865px) {


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


            #add_w{
                margin-top: 10px;
            }


        }

    </style>

    <body>

    <?php
        if ($stmt9->rowCount() > 0) {
            foreach ($results9 as $row9) {

                    if ($row9["status"] == 0)
                    {
                        echo '      <form action="#" method="post">
                                    <input type="submit" value="Szalon aktiválása" id="activate_salon" name="activate_salon" style="background-color: #47ff00">
                                    </form>';
                    }
                    else
                    {

                    }
            }
        }

    ?>

    <h1 style="justify-content: center; text-align: center">Munkás hozzáadása</h1>
    <form action="salon_info_checker.php" method="post">
    <div class="add-salon">
        <div class="form-group row" style="justify-content: center; width: 100%">
            <div class="col-sm-7">
                <label for="exampleFormControlSelect1">Munkás felhasználónév</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Felhasználónév...">
                <br><br><br>
                <label for="exampleFormControlSelect1">Vezetéknév</label>
                <input type="text" class="form-control" id="fname" name="fname" placeholder="Vezetéknév..."><br><br><br>
                <label for="exampleFormControlSelect1">Keresztnév</label>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="Keresztnév..."><br><br><br>
                <label for="exampleFormControlSelect1">Jelszó</label>
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Jelszó..."><br><br><br>
                <label for="exampleFormControlFile1">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail..."><br><br><br>
                <label for="exampleFormControlFile1">Munkás kép</label>
                <input type="file" class="form-control-file" id="image" name="image"><br><br><br>

                <?php
                if (isset($_GET["error"]) and $_GET["error"] == 1)
                {
                    echo "<div class='error1'><a>Töltsön ki minden mezőt!</a></div>";
                }

                if (isset($_GET["ok"]) and $_GET["ok"] == 1)
                {
                    echo "<div class='ok1' style='margin-top: 30px;'><a>Hozzáadva! Erősitse meg az emailt!</a></div>";
                }
                ?>
                <input type="submit" value="Hozzáadás" id="add" name="add">
    </form>
    <hr>
    <h1 style="justify-content: center; text-align: center">Munkaidő</h1><br>
    <form action="worker_hours.php" method="post">
        <select style="width: 100%; text-align: center;" name="workers" id="workers">
        <?php
        if ($stmt->rowCount() > 0) {
            foreach ($results as $row) {
                $fullname = $row["firstname"];
               $id_user = $row["id_user"];
               $_SESSION["idke"] = $id_user;
                ?>

        <?php echo "<option>$fullname</option>"?>
    <?php }?>
        <?php }?>
        </select><br><br>
    <label for="exampleFormControlFile1">Munkanap</label><br>
    <input type="date" id="days" name="days" style="width: 100%; text-align: center;"><br><br><br>

    <label for="exampleFormControlFile1">Munkaidő</label><br>
    <div class="time" style="justify-content: center; text-align: center">
        <input type="time" style="width: 40%; justify-content: center; text-align: center" name="time1" id="time1"><a>-</a><input type="time" style="width: 40%; justify-content: center; text-align: center" name="time2" id="time2">
    </div>

     <input type="submit" value="Hozzáadás" id="add_w" name="add_w">

        <?php
        if (isset($_GET["error"]) && $_GET["error"] == 5)
        {
            echo "<div class='error1'><a>Töltsön ki minden mezőt!</a></div>";
        }

        if (isset($_GET["r"]) && $_GET["r"] == 6)
        {
            echo "<div class='ok1'><a>Hozzáadva!</a></div>";
        }
        ?>
    </form>
    <hr>
    <h1 style="justify-content: center; text-align: center">Foglalások</h1><br>
    <table class="table" style="width: 100%; text-align: center; justify-content: center; margin: 2rem auto;">
        <thead class="thead" style="background-color: #9E8A78;">
        <tr>
            <th scope="col">Felhasználónév</th>
            <th scope="col">Időtartam</th>
            <th scope="col">Ár</th>
            <th scope="col">Szolgáltatás név</th>
            <th scope="col">Dátum</th>
            <th scope="col">Időpont</th>
            <th scope="col">Kinél</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($stmt->rowCount() > 0) {
        foreach ($results2 as $row2) {

            $id_reservation = $row2["id_reservation"];
            $duration = $row2["duration"];
            $price = $row2["price"];
            $service_name = $row2["service_name"];
            $date = $row2["date"];
            $time = $row2["time"];



            ?>
            <tr>
                <td><?php echo $row2["username"]?></td>
                <td><?php echo $row2["duration"] ." ". "Perc"?></td>
                <td><?php echo $row2["price"] . " " . "FT"?></td>
                <td><?php echo $row2["service_name"]?></td>
                <td><?php echo $row2["date"]?></td>
                <td><?php echo $row2["time"]?></td>
                <td>
                    <?php if ($stmt1->rowCount() > 0) {
                        foreach ($results1 as $row1) {

                            $fl = $row1["firstname"] ." ". $row1["lastname"];

                            if ($row2["id_worker_user"] == $row1["id_user"])
                            {
                                echo $fl;
                            }
                        }
                    }
                    ?>
                </td>

                <?php echo '<td><form action="delete_reservation.php" method="post">
                <input type="submit" style="width: 100%; background-color: #ff0000; border: 0; border-radius: 5px; padding: 8px" value="Törlés" name="delete1">
                <input hidden value="'.$salon_id.'" name="id" id="id" ">
                <input hidden value="'.$id_reservation.'" name="id_reservation" id="id_reservation" ">
                </form></td>' ?>

                <?php echo '<td><form action="modify_reservation.php" method="post">
                <input type="submit" style="width: 100%; background-color: #ffff00; border: 0; border-radius: 5px; padding: 8px" value="Módositás" name="modify1">
                <input hidden value="'.$id_reservation.'" name="id_reservation" id="id_reservation" ">
                <input hidden value="'.$salon_id.'" name="id" id="id" ">
                <input hidden value="'.$duration.'" name="duration" id="duration" ">
                <input hidden value="'.$price.'" name="price" id="price" ">
                <input hidden value="'.$service_name.'" name="service_name" id="service_name" ">
                <input hidden value="'.$date.'" name="date" id="date" ">
                <input hidden value="'.$time.'" name="time" id="time" ">
                </form></td>' ?>

                <?php echo '<td><form action="archived_reservation.php" method="post">
                <input type="submit" style="width: 100%; background-color: #ffA500; border: 0; border-radius: 5px; padding: 8px" value="Archiválás" name="archived">
                <input hidden value="'.$salon_id.'" name="id" id="id" ">
                <input hidden value="'.$id_reservation.'" name="id_reservation" id="id_reservation" ">
                </form></td>' ?>

            </tr>
        <?php } ?>
        </tbody>
        <?php } ?>
    </table>


    <hr>
    <h1 style="justify-content: center; text-align: center">Lemondott/Törölt foglalások</h1><br>
    <table class="table" style="width: 100%; text-align: center; justify-content: center; margin: 2rem auto;">
        <thead class="thead" style="background-color: #9E8A78;">
        <tr>
            <th scope="col">Felhasználónév</th>
            <th scope="col">Időtartam</th>
            <th scope="col">Ár</th>
            <th scope="col">Szolgáltatás név</th>
            <th scope="col">Dátum</th>
            <th scope="col">Időpont</th>
            <th scope="col">Kinél</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($stmt4->rowCount() > 0) {
        foreach ($results4 as $row4) {

            $id_reservation = $row4["id_reservation"];
            $duration = $row4["duration"];
            $price = $row4["price"];
            $service_name = $row4["service_name"];
            $date = $row4["date"];
            $time = $row4["time"];



            ?>
            <tr>
                <td><?php echo $row4["username"]?></td>
                <td><?php echo $row4["duration"] ." ". "Perc"?></td>
                <td><?php echo $row4["price"] . " " . "FT"?></td>
                <td><?php echo $row4["service_name"]?></td>
                <td><?php echo $row4["date"]?></td>
                <td><?php echo $row4["time"]?></td>
                <td>
                    <?php if ($stmt1->rowCount() > 0) {
                        foreach ($results1 as $row1) {

                            $fl = $row1["firstname"] ." ". $row1["lastname"];

                            if ($row4["id_worker_user"] == $row1["id_user"])
                            {
                                echo $fl;
                            }
                        }
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
        <?php } ?>
    </table>
    <hr>
    <h1 style="justify-content: center; text-align: center">Archivált foglalások</h1><br>
    <table class="table" style="width: 100%; text-align: center; justify-content: center; margin: 2rem auto;">
        <thead class="thead" style="background-color: #9E8A78;">
        <tr>
            <th scope="col">Felhasználónév</th>
            <th scope="col">Időtartam</th>
            <th scope="col">Ár</th>
            <th scope="col">Szolgáltatás név</th>
            <th scope="col">Dátum</th>
            <th scope="col">Időpont</th>
            <th scope="col">Kinél</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($stmt5->rowCount() > 0) {
        foreach ($results5 as $row5) {

            $id_reservation = $row5["id_reservation"];
            $duration = $row5["duration"];
            $price = $row5["price"];
            $service_name = $row5["service_name"];
            $date = $row5["date"];
            $time = $row5["time"];



            ?>
            <tr>
                <td><?php echo $row5["username"]?></td>
                <td><?php echo $row5["duration"] ." ". "Perc"?></td>
                <td><?php echo $row5["price"] . " " . "FT"?></td>
                <td><?php echo $row5["service_name"]?></td>
                <td><?php echo $row5["date"]?></td>
                <td><?php echo $row5["time"]?></td>
                <td>
                    <?php if ($stmt1->rowCount() > 0) {
                        foreach ($results1 as $row1) {

                            $fl = $row1["firstname"] ." ". $row1["lastname"];

                            if ($row5["id_worker_user"] == $row1["id_user"])
                            {
                                echo $fl;
                            }
                        }
                    }
                    ?>
                </td>
                <td><?php echo '<td>
                <form action="archived_reservation.php" method="post">
                <input hidden value="'.$salon_id.'" name="id" id="id" ">
                <input hidden value="'.$id_reservation.'" name="id_reservation" id="id_reservation" ">
                <input type="submit" style="width: 100%; background-color: #47ff00; border: 0; border-radius: 5px; padding: 8px" value="Vissza" name="archived1">
                </form></td>'?></td>
            </tr>
        <?php } ?>
        </tbody>
        <?php }
        ?>
    </table>

    <?php
    if (isset($_GET["ok"]) and $_GET["ok"] == 11)
    {
        echo "<div class='ok1' style='margin-top: 30px;'><a>Törölve</a></div>";
    }
    ?>

    <?php
    if (isset($_GET["ok"]) and $_GET["ok"] == 12)
    {
        echo "<div class='ok1' style='margin-top: 30px;'><a>Módositva</a></div>";
    }
    ?>

    </div>
    </div>


    </body>
    </html>


<?php
if (isset($_POST["activate_salon"]))
{
    $sql = "UPDATE salons SET status = 1 WHERE id_salon = :id_user";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_user',$salon_id , PDO::PARAM_STR);
    $stmt->execute();
}
?>

<?php
include "includes/footer.php";
?>