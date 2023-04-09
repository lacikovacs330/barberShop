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
            if ($row["role"]!="owner")
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




$sql = "SELECT * FROM salons WHERE id_user = '$_SESSION[id_user]'";
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
        $id = $row["id_salon"];
    echo '<div class="card" style="width: 18rem;">
            <img class="card-img-top" src="img/' . $row["image"] .'" alt="Card image cap" style="width: 100%" height="380px">
            <div class="card-body">
            <h5 class="card-title">' . $row["name"] . '</h5>
            <p class="card-text">' . $row["description"] . '</p>
           </div>
        <div class="card-body">
            <form action="salon_info.php" method="post">
            <input hidden name="salon_id" id="salon_id" value="'.$id.'">
            <button type="submit" id="buttons" name="buttons" class="btn" style="background-color: #9E8A78"><a style="text-decoration: none; color: black;">Információ</a></button>
            </form>
        </div>
        </div>';?>

<?php
    $_SESSION["id"] = $id;
    } ?>
<?php }?>
</div>
</body>
</html>

<?php


?>


<?php
include "includes/footer.php";
?>

