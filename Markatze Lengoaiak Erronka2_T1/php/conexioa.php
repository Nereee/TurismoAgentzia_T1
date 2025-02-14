<?php

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "db_bidaiaagentzia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Fallo en la conexión: " . $conn->connect_error);
}
?>