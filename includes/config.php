<?php

const PARAMS = [
    "HOST" => 'localhost',
    "USER" => 'misura',
    "PASS" => 'CsSClJ8k4cDYlIr',
    "DBNAME" => 'misura'
];

$dsn = "mysql:host=" . PARAMS['HOST'] . ";dbname=" . PARAMS['DBNAME'] . ";charset=utf8mb4";

$pdoOptions = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
