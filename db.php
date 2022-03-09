<?php
$servername = "localhost";
$username = "root";
$password = "";

try {

    $conn  = new PDO("mysql:host=$servername; dbname=weblog", $username, $password);
} catch (PDOException $e) {
    echo $e->getMessage();
}
