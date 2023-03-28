<?php
include "includes/nav.php";

$conn = connectDatabase($dsn, $pdoOptions);

$sql = "SELECT * FROM salons";
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
        <title>Document</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

    <div class="salons">
        <?php
        if ($stmt->rowCount() > 0) {
        foreach ($results as $row) {
        $id_salon = $row["id_salon"];
        if ($row["ban"] == 0 and $row["status"] == 1)
        {
            echo '<div class="card" style="width: 18rem;">
            <img class="card-img-top" src="img/' . $row["image"] .'" alt="Kép" style="width: 100%" height="380px">
            <div class="card-body">
            <h5 class="card-title">' . $row["name"] . '</h5>
            <p class="card-text">' . $row["description"] . '</p>
        </div>
        <div class="card-body">
            <form action="workers.php" method="post">
            <input hidden name="salons" id="salons" value="'.$id_salon.'">   
            <button type="submit" id="buttons" name="buttons" class="btn" style="background-color: #9E8A78"><a style="text-decoration: none; color: black;">Fodrászok</a></button>
            </form>  
        </div>
         </div>
        ';
        }
        else
        {

        }
        ?>

    <?php } ?>
    <?php } ?>

    <?php
    if (isset($_GET["r"]) && $_GET["r"] == 6)
    {
        echo "<div class='ok1'><a>Lefoglalva!</a></div>";
    }

    if (isset($_GET["error"]) && $_GET["error"] == 1)
    {
        echo "<div class='error1'><a>Nem sikerült a lefoglalás! Probálja meg újra!</a></div>";
    }
    ?>
    </div>

    </body>
    </html>


<?php
include "includes/footer.php";
?>