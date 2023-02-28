<?php
include "includes/nav.php";


$conn = connectDatabase($dsn, $pdoOptions);

if (isset($_GET["id"])){
    $id_salon = $_GET["id"];

}
else
{
    header("Location:salons.php");
}

$sql = "SELECT * FROM workers WHERE id_salon = '$id_salon'";
$stmt = $conn->prepare($sql);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


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


            $slq = "SELECT * FROM users WHERE id_user = '$id_user'";
            $stmt1 = $conn->prepare($slq);
            $stmt1->execute();

            $result = $stmt1->fetchAll(PDO::FETCH_ASSOC);

            if ($stmt1->rowCount() > 0) {
                foreach ($result as $row1) {

                        if ($row1["status"] == 1){

                            $salon_id = $row["id_salon"];
                            $_SESSION["id_salon1"] = $salon_id;

                            echo '<div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="img/' . $row["image"] .'" alt="Card image cap" style="width: 100%" height="380px">
                        <div class="card-body">
                            <h5 class="card-title">' . $row["firstname"] . " " . $row["lastname"] . '</h5>
                        </div>
                        ';


                                echo '<div class="card-body"><button type="button" class="btn" id="buttonw" name="buttonw" style="background-color: #9E8A78"><a href="time_duration.php?id='.$id_user.'&salon_id='.$id_salon.'" style="text-decoration: none; color: #000000;">Időpont választás</a></button></div></div>';
                            ?>
            <?php
                        }
                    }
                }
        }
    }?>
        </div>
    </body>
    </html>

<?php
include "includes/footer.php";
?>