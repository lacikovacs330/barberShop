<?php
session_start();

include "includes/config.php";
include "includes/db_config.php";

$conn = connectDatabase($dsn, $pdoOptions);



if (isset($_POST["sb-login"]) and isset($_POST["usname"]) and !empty($_POST["usname"]) and isset($_POST["password"]) and !empty($_POST["password"]))
{
    $username = $_POST["usname"];
    $password = $_POST["password"];
    $stmt = $conn->query("SELECT * FROM users WHERE username = '$username' ");
    if ($row = $stmt->fetch()) {
        $role = $row["role"];
        $_SESSION["role"] = $role;
        $usname = $row["username"];
        $id_user = $row["id_user"];
        $_SESSION["un"] = $usname;
        $_SESSION["id_user"] = $id_user;
        $pass = $row["password"];
        $_SESSION["password1"] = $pass;
        $token = $row["token"];
        $status = $row["status"];

        if (password_verify($password, $pass))
        {
            if ($status === 0)
            {
                header("Location:login.php?error=5");
            }
            else
            {
                require_once "vendor/autoload.php";
                require_once "vendor/mobiledetect/mobiledetectlib/src/MobileDetect.php";

                $detect = new \Detection\MobileDetect();
                $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
                $ipAddress = getIpAddress();
                $userAgent = $_SERVER["HTTP_USER_AGENT"];
                $accept = $_SERVER["HTTP_ACCEPT"];
                $countryCode = getCountryCode($ipAddress);

                global $dsn, $pdoOptions;
                $pdo = connectDatabase($dsn, $pdoOptions);

                $sql = "INSERT INTO logs(id_user, device_type, http_accept, http_user_agent, ip_address, country_code) 
                VALUES (:id, :device_type, :http_accept, :user_agent, :ip_address, :country_code)";

                $query = $pdo->prepare($sql);
                $query->bindParam(':id', $_SESSION["id_user"], PDO::PARAM_INT);
                $query->bindParam(':device_type', $deviceType, PDO::PARAM_STR);
                $query->bindParam(':http_accept', $accept, PDO::PARAM_STR);
                $query->bindParam(':user_agent', $userAgent, PDO::PARAM_STR);
                $query->bindParam(':ip_address', $ipAddress, PDO::PARAM_STR);
                $query->bindParam(':country_code', $countryCode, PDO::PARAM_STR);
                $query->execute();

                $lastInsertedId = $pdo->lastInsertId();

                if ($lastInsertedId > 0)
                {
                    header("Location:index.php");
                }

            }
        }
        else
        {
            header("Location:login.php?error=1");
        }
    }
    else
    {
        header("Location:login.php?error=1");
    }
}
else
{
    header("Location:login.php?error=1");
}



function getIpAddress(): string
{

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    if (!filter_var($ip, FILTER_VALIDATE_IP)) {
        $ip = "unknown";
    }

    return $ip;
}

function getCountryCode(string $ipAddress):array
{
    $url = "https://api.country.is/$ipAddress";
    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    $result = json_decode($response, true);

    return $result;
}