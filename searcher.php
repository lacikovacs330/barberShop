<?php
include 'includes/nav.php';
$conn = connectDatabase($dsn, $pdoOptions);

if (!isset($_SESSION["id_user"]))
{
    header("Location:index.php");
}

$searchErr = '';
$employee_details='';
if(isset($_POST['save']))
{
    if(!empty($_POST['search']))
    {
        $search = $_POST['search'];
        $stmt = $conn->prepare("select * from salons where name like '%$search%'");
        $stmt->execute();
        $employee_details = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //print_r($employee_details);
    }
    else
    {
        $searchErr = "Please enter the information";
    }

}

$sql = "SELECT * FROM salons";
$stmt = $conn->prepare($sql);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <form class="form-horizontal" action="#" method="post">
        <div class="input-group" style="width: 100%">
            <div class="inputs" style="width: 50%; display: flex; margin: 5rem auto">
            <input type="search" class="form-control rounded" placeholder="Keresés..." aria-label="Search" aria-describedby="search-addon" name="search" id="search"/>
            <button type="submit" class="btn btn-outline-secondary" id="save" name="save">Keresés</button>
            </div>
        </div>
    </form>
    <div class="salons">
            <?php
            if(!$employee_details)
            {

            }
            else{
                foreach($employee_details as $row)
                {
                $id_salon = $row["id_salon"];
                    ?>

                    <?php
                    if($row["ban"] == 0 and $row["status"] == 1) {
                        echo '
                            <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="img/' . $row["image"] . '" alt="Kép" style="width: 100%" height="380px">
                            <div class="card-body">
                            <h5 class="card-title">' . $row["name"] . '</h5>
                            <p class="card-text">' . $row["description"] . '</p>
                            </div>
                            <div class="card-body">
                            <form action="workers.php" method="post">
                            <input hidden name="salons" id="salons" value="' . $id_salon . '">  
                            <button type="submit" id="buttons" name="buttons" class="btn" style="background-color: #9E8A78"><a style="text-decoration: none; color: black;">Fodrászok</a></button>
                            </div>
                            </form>
                            </div>
                            ';
                    }
                    else
                    {

                    }
                    ?>

                    <?php
                }
            }
            ?>
    </div>

<script src="jquery-3.2.1.min.js"></script>
<script src="bootstrap.min.js"></script>
</body>
</html>

<?php
include "includes/footer.php";
?>