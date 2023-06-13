<?php

include "includes/nav.php";

$d = date("Y-m-d");

$conn = connectDatabase($dsn, $pdoOptions);

$realdate = date("Y-m-d", strtotime(" + 1 day"));

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

$sql10 = "SELECT * FROM workers_hours WHERE salon_id = '$salon_id'";
$stmt10 = $conn->prepare($sql10);
$stmt10->execute();

$results10 = $stmt10->fetchAll(PDO::FETCH_ASSOC);


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
    <form action="salon_info_checker.php" method="post" enctype="multipart/form-data">
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

                    if (isset($_GET["error"]) && $_GET["error"] == 9)
                    {
                        echo "<div class='error1'><a>Foglalt felhasználónév</a></div>";
                    }

                    if (isset($_GET["error"]) && $_GET["error"] == 8)
                    {
                        echo "<div class='error1'><a>Foglalt email</a></div>";
                    }

                    if (isset($_GET["error"]) && $_GET["error"] == 10)
                    {
                        echo "<div class='error1'><a>Foglalt kép</a></div>";
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
            <option value="" disabled selected>Válasszon munkást</option>
            <?php
            if ($stmt->rowCount() > 0) {
                foreach ($results as $row) {
                    $fullname = $row["firstname"];
                    $id_user = $row["id_user"];
                    $_SESSION["idke"] = $id_user;
                    ?>


                    <?php
                    if ($stmt1->rowCount() > 0) {
                        foreach ($results1 as $row1) {
                            if($row1["status"] === 1 && $row["id_user"] === $row1["id_user"])
                            {
                                echo "<option value='$id_user'>$fullname</option>";
                            }
                        }
                    }
                    ?>

                <?php }?>

            <?php }?>
        </select><br><br>
        <label for="exampleFormControlFile1">Munkanap</label><br>
        <input type="date" id="days" name="days" style="width: 100%; text-align: center;"><br><br><br>
        <label for="exampleFormControlFile1">Munkaidő</label><br>
        <div class="time" style="justify-content: center; text-align: center">
            <input type="time" style="width: 40%; justify-content: center; text-align: center" name="time1" id="time1"><a>-</a><input type="time" style="width: 40%; justify-content: center; text-align: center" name="time2" id="time2">
            <input hidden name="salons" id="salons" value="<?php echo $salon_id;?>">
        </div>

        <input type="submit" value="Hozzáadás" id="add_w" name="add_w">

        <?php
        if (isset($_GET["error"]) && $_GET["error"] == 5)
        {
            echo "<div class='error1'><a>Töltsön ki minden mezőt!</a></div>";
        }

        if (isset($_GET["error"]) && $_GET["error"] == 205)
        {
            echo "<div class='error1'><a>Mettől nelegyen nagyobb mint a meddig!</a></div>";
        }

        if (isset($_GET["error"]) && $_GET["error"] == 201)
        {
            echo "<div class='error1'><a>Ne legyen kissebb a mai dátumnál!</a></div>";
        }

        if (isset($_GET["r"]) && $_GET["r"] == 6)
        {
            echo "<div class='ok1'><a>Hozzáadva!</a></div>";
        }
        ?>
    </form>


    <hr>
    <h1 style="justify-content: center; text-align: center">Munkaidők</h1><br>
    <table class="table" style="width: 100%; text-align: center; justify-content: center; margin: 2rem auto;">
        <thead class="thead" style="background-color: #9E8A78;">
        <tr>
            <th scope="col">Név</th>
            <th scope="col">Nap</th>
            <th scope="col">Mettöl</th>
            <th scope="col">Meddig</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $hasStatusOne = false;
        if ($stmt->rowCount() > 0) {
        foreach ($results10 as $row10) {

            $id_hour = $row10["id_hour"];
            $id_user = $row10["id_user"];
            $day = $row10["day"];
            $from_hour = $row10["from_hour"];
            $to_hour = $row10["to_hour"];

            if ($realdate < $day)
            {

                ?>
                <tr>
                    <td>
                        <?php if ($stmt1->rowCount() > 0) {
                            foreach ($results1 as $row1) {
                                $hasStatusOne = true;
                                $fl = $row1["firstname"] ." ". $row1["lastname"];

                                if ($row10["id_user"] == $row1["id_user"])
                                {
                                    echo $fl;
                                }
                            }
                        }
                        ?>
                    </td>
                    <td><?php echo $row10["day"];?></td>
                    <td><?php echo $row10["from_hour"];?></td>
                    <td><?php echo $row10["to_hour"];?></td>

                    <?php echo '<td>
                    <form action="delete_reservation.php" method="post" onsubmit="return confirm(\'Biztosan törölni szeretnéd a munkaidőt?\')">
                    <input type="submit" style="width: 100%; background-color: #ff0000; border: 0; border-radius: 5px; padding: 8px" value="Törlés" name="delete100">
                    <input type="hidden" value="'.$salon_id.'" name="id" id="id">
                    <input type="hidden" value="'.$id_hour.'" name="id_hour" id="id_hour">
                    </form>
                    </td>' ?>

                    <?php echo '<td><form action="modify_time.php" method="post">
                <input type="submit" style="width: 100%; background-color: #ffff00; border: 0; border-radius: 5px; padding: 8px" value="Módositás" name="modify100">
                <input hidden value="'.$id_hour.'" name="id_hour" id="id_hour" ">
		    <input type="hidden" value="'.$salon_id.'" name="id_salon" id="id_salon">
                <input hidden value="'.$day.'" name="day" id="day" ">
                <input hidden value="'.$from_hour.'" name="from_hour" id="from_hour" ">
                <input hidden value="'.$to_hour.'" name="to_hour" id="to_hour" ">
                </form></td>' ?>
                </tr>
            <?php }
        }?>
        </tbody>
        <?php }
        if (!$hasStatusOne) {
            echo "<div style='text-align: center; justify-content: center; width: 100%;'>";
            echo "<h1>Nincs megjeleníthető munkaidő</h1>";
            echo "</div>";
        }
        ?>
    </table>
    <?php
    if (isset($_GET["ok"]) && $_GET["ok"] == 100)
    {
        echo "<div class='ok1'><a>Törölve!</a></div>";
    }

    if (isset($_GET["ok"]) && $_GET["ok"] == 101)
    {
        echo "<div class='ok1'><a>Módositva!</a></div>";
    }

    if (isset($_GET["error"]) && $_GET["error"] == 101)
    {
        echo "<div class='error1'><a>Ne legyen kissebb a mai napnál!</a></div>";
    }

    if (isset($_GET["error"]) && $_GET["error"] == 105)
    {
        echo "<div class='error1'><a>A mettől ne legyen nagyobb mint a meddig!</a></div>";
    }

    if (isset($_GET["error"]) && $_GET["error"] == 102)
    {
        echo "<div class='error1'><a>Töltsön ki minden mezőt</a></div>";
    }

    if (isset($_GET["error"]) && $_GET["error"] == 150)
    {
        echo "<div class='error1'><a>Töltsön ki minden mezőt</a></div>";
    }
    ?>
































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
        $hasStatusOne = false;
        if ($stmt->rowCount() > 0) {
        foreach ($results2 as $row2) {

            $id_reservation = $row2["id_reservation"];
            $duration = $row2["duration"];
            $price = $row2["price"];
            $service_name = $row2["service_name"];
            $date = $row2["date"];
            $time = $row2["time"];

            if ($realdate < $date)
            {

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
                                $hasStatusOne = true;
                                $fl = $row1["firstname"] ." ". $row1["lastname"];

                                if ($row2["id_worker_user"] == $row1["id_user"])
                                {
                                    echo $fl;
                                }
                            }
                        }
                        ?>
                    </td>

                    <?php echo '<td>
    <form action="delete_reservation.php" method="post" onsubmit="return confirm(\'Biztosan törölni szeretnéd a foglalást?\')">
        <input type="submit" style="width: 100%; background-color: #ff0000; border: 0; border-radius: 5px; padding: 8px" value="Törlés" name="delete1">
        <input type="hidden" value="'.$salon_id.'" name="id" id="id">
        <input type="hidden" value="'.$id_reservation.'" name="id_reservation" id="id_reservation">
    </form>
</td>' ?>




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
            <?php }
        }?>
        </tbody>
        <?php }
        if (!$hasStatusOne) {
            echo "<div style='text-align: center; justify-content: center; width: 100%;'>";
            echo "<h1>Nincs megjeleníthető foglalás</h1>";
            echo "</div>";
        }
        ?>
    </table>

    <?php
    if (isset($_GET["ok"]) and $_GET["ok"] == 11)
    {
        echo "<div class='ok1' style='margin-top: 30px;'><a>Törölve</a></div>";
    }


    if (isset($_GET["ok"]) and $_GET["ok"] == 12)
    {
        echo "<div class='ok1' style='margin-top: 30px;'><a>Módositva</a></div>";
    }

    if (isset($_GET["error"]) and $_GET["error"] == 12)
    {
        echo "<div class='error1' style='margin-top: 30px;'><a>Módositás sikertelen hibás paraméterek.</a></div>";
    }

    if (isset($_GET["error"]) and $_GET["error"] == 13)
    {
        echo "<div class='error1' style='margin-top: 30px;'><a>Töltsön ki minden mezőt!.</a></div>";
    }


    ?>


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
        $hasStatusOne1 = false;
        if ($stmt4->rowCount() > 0) {
        foreach ($results4 as $row4) {

            $id_reservation = $row4["id_reservation"];
            $duration = $row4["duration"];
            $price = $row4["price"];
            $service_name = $row4["service_name"];
            $date = $row4["date"];
            $time = $row4["time"];

            if ($realdate < $date)
            {

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
                                $hasStatusOne1 = true;
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
            <?php }
        }
        ?>
        </tbody>
        <?php }

        if (!$hasStatusOne1) {
            echo "<div style='text-align: center; justify-content: center; width: 100%;'>";
            echo "<h1>Nincs megjeleníthető lemondott foglalás</h1>";
            echo "</div>";
        }
        ?>
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
        $hasStatusOne2 = false;
        if ($stmt5->rowCount() > 0) {
        foreach ($results5 as $row5) {

            $id_reservation = $row5["id_reservation"];
            $duration = $row5["duration"];
            $price = $row5["price"];
            $service_name = $row5["service_name"];
            $date = $row5["date"];
            $time = $row5["time"];

            if ($realdate < $date)
            {


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
                                $hasStatusOne2 = true;
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
            <?php }
        }?>
        </tbody>
        <?php }
        if (!$hasStatusOne2) {
            echo "<div style='text-align: center; justify-content: center; width: 100%;'>";
            echo "<h1>Nincs megjeleníthető archivált foglalás</h1>";
            echo "</div>";
        }


        ?>
    </table>

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