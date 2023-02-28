<?php
include 'includes/nav.php';
$conn = connectDatabase($dsn, $pdoOptions);

$s_name = $_GET["s_name"];
$service = $_GET["service"];
$price = $_GET["price"];
$duration = $_GET["duration"];

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
<div class="register-system">
    <div class="login-title">
        <a><b>Szolgáltatás megváltoztatása</b></a>
    </div><br>
    <hr class="register-hr">
    <div class="register-inputs">
        <?php echo '<form action="modify_service2.php?s_name='.$s_name.'&service='.$service.'&price='.$price.'&duration='.$duration.'" method="post">' ?>
            <label>Név</label>
            <input type="text" id="s_name1" name="s_name1" placeholder="Szolgáltatás neve...">

            <label>Ár</label>
            <input type="text" id="price1" name="price1" placeholder="Ár...">

            <label>Időtartam</label>
            <input type="text" id="duration1" name="duration1" placeholder="Időtartam...">

            <?php
            if (isset($_GET["ok"]) and $_GET["ok"] == 1)
            {
            echo "<div class='ok1' style='width: 50%; margin: 1rem auto;'><a>Megváltoztatva!</a></div>";
            }
            ?>

            <input type="submit" value="Megváltoztatás" name="sub" id="sub">
        </form>
    </div>
</div>
</body>
</html>

<?php
include 'includes/footer.php';
?>
