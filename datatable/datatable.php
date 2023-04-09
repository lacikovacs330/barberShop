<?php
include "../includes/config.php";
include "../includes/db_config.php";
session_start();

$conn = connectDatabase($dsn, $pdoOptions);

if (isset($_SESSION["id_user"]))
{
    $sql = "SELECT * FROM users WHERE id_user = '$_SESSION[id_user]'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
        foreach ($results as $row) {
            if ($row["role"]!="admin")
            {
                header("Location:../index.php");
            }
        }
    }
}
else
{
    header("Location:../index.php");
}


$sql = "SELECT * FROM users ORDER BY id_user ASC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM salons ORDER BY id_salon ASC";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute();
$results2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>DataTable</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
</head>
<body>
<br /><br />
<a href="../index.php">Vissza a kezdő oldalra!</a>
<div class="container">
    <h3 align="center">Felhasználók</h3>
    <br />
    <div class="table-responsive">
        <table id="employee_data" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Status</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            </thead>
            <?php
            if ($stmt->rowCount() > 0) {
                foreach ($results as $row) {
                    echo '<tr>';
                    echo '<td>' . $row["id_user"] . '</td>';
                    echo '<td>' . $row["username"] . '</td>';
                    echo '<td>' . $row["email"] . '</td>';
                    echo '<td>' . $row["status"] . '</td>';
                    echo '<td>' . $row["role"] . '</td>';
                    echo '<td>';
                    if ($row["status"] == 0) {
                        echo '<a href="edit_user.php?id=' . $row["id_user"] . '&status=1">Visszaállítás</a>';
                    } else {
                        echo '<a href="edit_user.php?id=' . $row["id_user"] . '&status=0">Bannolás</a>';
                    }
                    echo '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
    </div>
</div>


<div class="container">
    <h3 align="center">Szalonok</h3>
    <br />
    <div class="table-responsive">
        <table id="employee_data1" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Név</th>
                <th>Leirás</th>
                <th>Status</th>
                <th>Ban</th>
                <th>Action</th>
            </tr>
            </thead>
            <?php
            if ($stmt2->rowCount() > 0) {
                foreach ($results2 as $row2) {
                    echo '<tr>';
                    echo '<td>' . $row2["id_salon"] . '</td>';
                    echo '<td>' . $row2["name"] . '</td>';
                    echo '<td>' . $row2["description"] . '</td>';
                    echo '<td>' . $row2["status"] . '</td>';
                    echo '<td>' . $row2["ban"] . '</td>';
                    echo '<td>';
                    if ($row2["ban"] == 0) {
                        echo '<a href="edit_salon.php?id=' . $row2["id_user"] . '&ban=1">Bannolás</a>';
                    } else {
                        echo '<a href="edit_salon.php?id=' . $row2["id_user"] . '&ban=0">Visszaállitás</a>';
                    }
                    echo '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
    </div>
</div>

</body>
</html>
<script>
    $(document).ready(function(){
        $('#employee_data').DataTable();
    });

    $(document).ready(function(){
        $('#employee_data1').DataTable();
    });
</script>