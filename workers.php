<?php
include "includes/nav.php";

if (!isset($_POST["salons"]))
{
    header("Location:index.php");
}

$conn = connectDatabase($dsn, $pdoOptions);


$id_salon = $_POST["salons"];
$_SESSION["id_salon1"] = $id_salon;

$sql = "SELECT * FROM workers WHERE id_salon = '$id_salon'";
$stmt = $conn->prepare($sql);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql1 = "SELECT * FROM salons";
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
        <link rel="stylesheet" href="css/style.css">
        <title>Document</title>
    </head>
        <div class="workers">
            <?php
        if ($stmt->rowCount() > 0) {
        foreach ($results as $row) {
            $id_user = $row["id_user"];
            $_SESSION["id_user1"] = $id_user;

            $slq = "SELECT * FROM users WHERE id_user = '$id_user'";
            $stmt1 = $conn->prepare($slq);
            $stmt1->execute();

            $result = $stmt1->fetchAll(PDO::FETCH_ASSOC);

            if ($stmt1->rowCount() > 0) {
                foreach ($result as $row1) {

                        if ($row1["status"] == 1){

                            echo '<div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="img/' . $row["image"] .'" alt="Card image cap" style="width: 100%" height="380px">
                        <div class="card-body">
                            <h5 class="card-title">' . $row["firstname"] . " " . $row["lastname"] . '</h5>
                        </div>
                        ';


                                echo '
                                <form action="time_duration.php" method="post">
                                <input hidden value='.$id_user.' name="id_user" id="id_user">
                                
                                <div class="card-body"><button type="submit" class="btn" id="buttonw" name="buttonw"" style="background-color: #9E8A78"><a style="text-decoration: none; color: #000000;">Időpont választás
                                </a></button></form></div></div>';
                            ?>
            <?php
                        }
                    }
                }
        }
    }
    else {
        echo "<div style='text-align: center; justify-content: center; width: 100%;'>";
        echo "<h1>Ehhez a szalonhoz nincsenek munkások!</h1>";
        echo "</div>";
    }

        ?>
        </div>

    </body>
    </html>

<?php
include "includes/footer.php";
?>