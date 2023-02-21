<?php
include "includes/nav.php";
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
        body{
            width: 100%;
            height: 500px;
            justify-content: center;
            margin: 0;
        }

        @media only screen and (max-width: 1040px) {
            body{
                background-repeat: repeat;
            }
        }

        @media only screen and (max-width: 605px) {
            .appointments-system{
                width: 50%;
            }
        }
    </style>

    <body>
    <div class="profil-system">
        <div class="login-title">
            <a><b>Profil adatok</b></a>
        </div><br>
        <hr class="profil-hr">
        <div class="profil-inputs">
            <form method="post" action="profile-checker.php">
                <label for="username">Felhasználónév</label>
                <input type="text" id="uname" name="uname" placeholder="<?php echo $_SESSION["un"];?>">
                <label for="email">Jelszó</label>
                <input type="password" id="password" name="password" placeholder="Jelszó...">
                <label for="email">Új jelszó</label>
                <input type="password" id="password2" name="password2" placeholder="Új jelszó...">
                <?php
                if (isset($_GET["p"]) && $_GET["p"] == 6)
                {
                    echo "<div class='error1'><a>A két jelszó nem egyezik!</a></div>";
                }

                if (isset($_GET["p"]) && $_GET["p"] == 8)
                {
                    echo "<div class='error1'><a>Töltsön ki minden mezőt!</a></div>";
                }

                if (isset($_GET["p"]) && $_GET["p"] == 10)
                {
                    echo "<div class='error1'><a>Nem lehet ugyan az a jelszavad!</a></div>";
                }

                if (isset($_GET["p"]) && $_GET["p"] == 7)
                {
                    echo "<div class='ok1'><a>Megváltoztatva</a></div>";
                }
                ?>
                <input type="submit" id="success-sb" name="success-sb" value="Kész">
            </form>
        </div>
    </div>
    </body>
    </html>

<?php
include "includes/footer.php";
?>